<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
use App\Resume;
use App\Category;

class PagesController extends Controller
{
    /**
     * Show index page with random slides
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWelcomePage()
    {
        $categories = Category::all();
        $countVacancies = Vacancy::count();
        $countResumes = Resume::count();
        $vacancy = Vacancy::findOrFail(rand(1, $countVacancies));
        $resume = Resume::findOrFail(rand(1, $countResumes));
        return view('welcome', ['vacancy' => $vacancy, 'resume' => $resume,
            'categories' => $categories]);
    }

    /**
     * Search vacancies in "worker" and "guest" mode
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchVacancies(Request $request)
    {
        $search = $request['search'];
        $vacancies = Vacancy::latest()
            ->where('title', 'like', '%' . $search . '%')
            ->orWhere('company', 'like', '%' . $search . '%')
            ->orWhere('employment_type', 'like', '%' . $search . '%')
            ->orWhere('city', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();
        return view('global.search', ['vacancies' => $vacancies]);
    }

    /**
     * Show all vacancies page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllVacancies()
    {
        $vacancies = Vacancy::orderBy('vacancies.id', 'desc')
            ->paginate(8);
        return view('global.vacancies', ['vacancies' => $vacancies]);
    }

    /**
     * Show all resumes page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllResumes()
    {
        $resumes = Resume::orderBy('resumes.updated_at', 'desc')
              ->paginate(8);
        return view('global.resumes', ['resumes' => $resumes]);
    }

    /**
     * Show single resume page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getResume($id)
    {
        $resume = Resume::find($id);
        return view('global.resume', ['resume' => $resume]);
    }

    /**
     * Show single vacancy page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getVacancy($id)
    {
        $vacancy = Vacancy::find($id);
        return view('global.vacancy', ['vacancy' => $vacancy]);
    }

    /**
     * Download resume pdf file from single resume page
     *
     * @param $filename
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadResume($filename)
    {
        return response()->download(storage_path("app/uploads/" . $filename));
    }

    /**
     * Show all resumes in this category
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResumeCategory($id)
    {
        $resumes = Category::find($id)->resumes()
            ->paginate();
        return view('global.resumes', ['resumes' => $resumes]);
    }

    /**
     * Show all vacancies in this category
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showVacancyCategory($id)
    {
        $vacancies = Category::find($id)->vacancies()
            ->paginate();
        return view('global.vacancies', ['vacancies' => $vacancies]);
    }

}
