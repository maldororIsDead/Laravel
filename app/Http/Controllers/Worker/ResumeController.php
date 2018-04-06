<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resume;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Vacancy;
use App\ResumeVacancy;
use App\Category;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resumes = Resume::where('user_id', Auth::user()->id)
            ->get();

        return view('resume.index', ['resumes' => $resumes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('resume.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateResume($request);
        Resume::create($data);

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
        $resume = Resume::find($id);
        return view('resume.show', ['resume' => $resume]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resume = Resume::find($id);
        $resume['employment_type'] = explode(',', $resume['employment_type']);
        $categories = Category::all();

        return view('resume.edit', ['resume' => $resume, 'categories' => $categories]);
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
        $data = $this->validateResume($request);
        Resume::find($id)->update($data);

        $resumes = Resume::where('user_id', Auth::user()->id)
            ->get();
        return view('resume.index', ['resumes' => $resumes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Resume::destroy($id);
        return redirect('home');
    }

    /**
     * Validate update and insert resume forms
     *
     * @param $request
     * @return mixed
     */
    private function validateResume($request)
    {
        $resume = new Resume;
        $columns = $resume->getTableColumns();
        $this->validate($request, [
            'post' => 'required|max:100',
            'city' => 'required|max:30',
            'salary' => 'regex:/^\d+$/',
            'phone' => 'regex:/^\d+$/',
            'age' => 'regex:/^\d+$/',
            'category_id' => 'required',
            'education' => 'required|max:100',
            'employment_type' => 'required',
            'description' => 'required|max:1000'
        ], [
            'post.required' => 'Укажите должность, на которой хотите работать',
            'city.required' => 'Выберите желаемый город работы',
            'education.required' => 'Укажите ваше образование',
            'employment_type.required' => 'Выберите вид занятости',
            'salary.regex' => 'Задайте численное значение',
            'phone.regex' => 'Задайте численное значение',
            'description.required' => 'Опишите о себе',
            'age.required' => 'Введите ваш возраст',
            'category_id.required' => 'Выберите категорию'
        ]);
        foreach ($columns as $column) {

            if ($request[$column] === null) continue;
            if (gettype($request[$column]) == 'array') {
                $request[$column] = implode(",", $request[$column]);
            }
            $data[$column] = $request[$column];
        }
        $data['file'] = $this->fileUpload($request);
        return $data;
    }

    /**
     * Upload resume file
     *
     * @param $request
     * @return null|string
     */
    public function fileUpload($request)
    {
        $this->validate($request, [
            'file' => 'mimes:pdf|max:8048',
        ]);
        if ($request['file']) {
            $path = $request->file('file')->store('uploads');
            return basename($path);
        }
        return null;
    }

    /**
     * Vacancies were showing, which this resume had been spent
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSendVacancies($id)
    {
        $resume = Resume::find($id);
        return view('resume.vacancies', ['vacancies' => $resume->vacancies]);
    }

    /**
     * Show all resumes in select element, which is situated in each vacancy page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selectResume($id)
    {
        $vacancy = Vacancy::find($id);
        $resumes = Resume::where('user_id', Auth::user()->id)
            ->get();
        return view('global.vacancy', ['resumes' => $resumes, 'vacancy' => $vacancy]);
    }

    /**
     * Save vacancy/resume id values in "many to many" relation table
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendResume(Request $request)
    {
        $resumeVacancy = new ResumeVacancy;
        $resumeVacancy->resume_id = $request["resume_id"];
        $resumeVacancy->vacancy_id = $request["vacancy_id"];
        $resumeVacancy->save();

        return redirect('home');
    }
}
