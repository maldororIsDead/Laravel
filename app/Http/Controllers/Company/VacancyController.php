<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Category;
use App\Resume;


class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::where('user_id', Auth::user()->id)
            ->get();
        return view('vacancies.index', ['vacancies' => $vacancies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('vacancies.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateVacancy($request);
        Vacancy::create($data);
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacancy = Vacancy::find($id);
        return view('vacancies.show', ['vacancy' => $vacancy]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $vacancy = Vacancy::find($id);
        $vacancy['employment_type'] = explode(',', $vacancy['employment_type']);

        return view('vacancies.edit', ['vacancy' => $vacancy, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validateVacancy($request);
        $vacancy = Vacancy::find($id)->update($data);

        $vacancies = Vacancy::where('user_id', Auth::user()->id)
            ->get();
        return view('vacancies.index', ['vacancies' => $vacancies]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vacancy::destroy($id);

        $vacancies = Vacancy::where('user_id', Auth::user()->id)
            ->get();
        return view('vacancies.index', ['vacancies' => $vacancies]);
    }

    /**
     * Validate update and insert forms
     *
     * @param $request
     * @return mixed
     */
    private function validateVacancy($request)
    {
        $vacancy = new Vacancy;
        $columns = $vacancy->getTableColumns();
        $this->validate($request, [
            'title' => 'required|max:100',
            'company' => 'required|max:100',
            'requirements' => 'required|max:150',
            'city' => 'required|max:30',
            'salary' => 'regex:/^\d+$/',
            'category_id' => 'required',
            'phone' => 'required|regex:/^\d+$/',
            'contact_name' => 'required|max:100',
            'employment_type' => 'required',
            'description' => 'required|max:1500'
        ], [
            'title.required' => 'Укажите название вакансии',
            'company.required' => 'Укажите название вашей компании',
            'requirements.required' => 'Укажите требования к соискателю',
            'city.required' => 'Укажите ваш город',
            'contact_name.required' => 'Укажите контактное лицо',
            'employment_type.required' => 'Выберите тип занятости',
            'salary.regex' => 'Задайте численное значение',
            'phone.required' => 'Укажите контактный телефон',
            'phone.regex' => 'Задайте численное значение',
            'description.required' => 'Добавьте описание вакансии',
            'category_id.required' => 'Выберите категорию'
        ]);

        foreach ($columns as $column) {
            if ($request[$column] === null) continue;
            if (gettype($request[$column]) == 'array') {
                $request[$column] = implode(",", $request[$column]);
            }
            $data[$column] = $request[$column];
        }
        return $data;
    }

    /**
     * Resumes had been sent to vacation were showing
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showReceiveResumes($id)
    {
        $vacancy = Vacancy::find($id);
        return view('vacancies.resumes', ['resumes' => $vacancy->resumes]);
    }

    /**
     * Search resumes only in "company" role
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchResumes(Request $request)
    {
        $search = $request['search'];
        $resumes = Resume::latest()
            ->where('post', 'like', '%' . $search . '%')
            ->orWhere('city', 'like', '%' . $search . '%')
            ->orWhere('employment_type', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();
        return view('global.search', ['resumes' => $resumes, 'vacancies' => null]);
    }

}
