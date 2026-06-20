<?php

namespace App\Http\Controllers;

use App\Http\Requests\Main\ContactRequest;
use App\Services\MainService;

class MainController extends Controller
{
    public function __construct(
        private MainService $mainService
    ) {}

    public function home()
    {
        return view('home', $this->mainService->getHomeData());
    }

    public function about()
    {
        return view('about', $this->mainService->getAboutData());
    }

    public function projects()
    {
        return view('projects');
    }

    public function projectDetail(string $tipo)
    {
        return view('project_detail', $this->mainService->getProjectDetailData($tipo));
    }

    public function events()
    {
        return view('events', $this->mainService->getEventsData());
    }

    public function eventDetail(string $id)
    {
        return view('event_detail', $this->mainService->getEventDetailData($id));
    }

    public function contact()
    {
        return view('contact', $this->mainService->getContactData());
    }

    public function contactSubmit(ContactRequest $request)
    {
        $this->mainService->sendContact($request->validated());

        return redirect()->route('confirm');
    }

    public function confirm()
    {
        return view('confirm');
    }
}
