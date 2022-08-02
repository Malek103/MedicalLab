<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\LabSchedule;
use Illuminate\Http\Request;
use App\Models\Template_Item;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        // safa
        $lab = LabSchedule::find($id);
        return view('Template.create', compact('lab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'addMoreInputFields.*.subject' => 'required',
            'templateName' => ['required', 'max:255'],
            'id' => ['required'],
        ]);
        if(! isset($data['addMoreInputFields'])){

           return redirect()->back()->with('required', 'يجب اضافة حقول للقالب')->withInput($data);

        }
        // if(count($data['addMoreInputFields']) <= 0){
        //   return redirect()->back()->with('required', 'يجب اضافة حقول للقالب')->withInput($data);
        // }
        $template = new Template();
        $template->LID = $data['id'];
        $template->TName = $data['templateName'];
        $template->save();

        foreach ($data['addMoreInputFields'] as $key => $value) {
            $templateItem = new Template_Item();
            $templateItem->type = 'text';
            $templateItem->Name = $value['subject'];
            $templateItem->TTID = $template->id;
            $templateItem->save();
        }
        return redirect()->back()->with('success', 'تم انشاء قالب الفحص بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template,  $id)
    {
        $lab = LabSchedule::find($id);

        $templateItem  = Template_ITem::where('TTID', $template->id)->get();
        // dd($template->TName, $id);
        return view('Template.edit', compact('lab', 'template', 'templateItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {

        if($request->templateName){
            $temp = Template::find($request->templateId);
            $temp->TName = $request->templateName;
            $temp->update();
        }
        foreach ($request->edit as $key => $item) {
            if (!$item == null) {
                $updateItem = Template_Item::find($key);
                $updateItem->Name = $item;
                $updateItem->update();
            }
        }
        return redirect()->back()->with('success', 'تم تعديل القالب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
    public function  showAll($id)
    {
        $lab = LabSchedule::find($id);
        $templates = Template::where('LID', $id)->get();
        return view('Template.show')->with('lab', $lab)->with('templates', $templates);
    }
}
