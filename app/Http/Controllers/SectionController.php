<?php

namespace App\Http\Controllers;

use App\Http\Resources\SectionResource;
use App\Http\Resources\SectionTaskResource;
use App\Models\Section;
use App\Models\Task;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->has('q') ? $request->query('q') : null; // all

        $sections = Section::search($q)
                        ->get();

        return SectionResource::collection($sections);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = Section::create($request->all());

        return response()->json($section, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return new SectionResource($section);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sectionTask($sectionId, $taskId)
    {
        $section = Section::where('id', $sectionId)
                        ->with(['task' => function($q) use ($taskId) {
                            $q->where('id', $taskId);
                        }])
                        ->first();

            return new SectionTaskResource($section);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sectionTaskAll(Request $request) 
    {
        // Query Section
        $qs = $request->has('qs') ? $request->query('qs') : null; // all
        // Query Task
        $qt = $request->has('qt') ? $request->query('qt') : null; // all
        $state = $request->has('state') ? $request->query('state') : null; // all

        $sections = Section::search($qs)
                        ->with(['task' => function($task) use ($qt, $state) {
                            $task->search($qt)
                                ->state($state);
                        }])
                        ->get();

                        // return $sections;
        return SectionTaskResource::collection($sections);
    }

    public function sectionUndo($sectionId) 
    {
        Section::withTrashed()->find($sectionId)->restore();
        Task::withTrashed()->where('section_id', $sectionId)->restore();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $section->update($request->all());

        $res = new SectionResource($section);

        return response()->json($res, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return response()->json(null, 204);
    }
}
