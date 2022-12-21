<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormDefinition;
use App\Models\FormSubmission;

class FormController extends Controller
{
    public function create()
    {
        // $l = json_decode(FormDefinition::find(1)->definition);
        // dd(json_encode($l->components[0]->validate));
        return view('form')->with([
            'definition' => FormDefinition::find(1)->definition, // get some definition JSON
            'data' => '{}', // you can edit a form by providing the old data 
        ]);

    }
    
    public function store(Request $request)
    {
        // dd($request->get('submissionValues'));
           if ($request->get('state') === 'draft') {
            // Someone added a 'Save Draft' button to the form, and the user clicked that.
            // You can do some different behaviours if you'd like.
        }
        // $validate =json_decode(FormDefinition::find(1)->definition);
        $data = $request->validateDynamicForm(
            FormDefinition::find(1)->definition, // get some definition JSON
            $request->get('submissionValues'),
            null
        );
        dd($data);
        
        // Here is your validated form data
        // dd($data);
        FormSubmission::create(['data'=>$request->get('submissionValues')]);
    }

    public function show()
    {
        return view('show')->with([
            'definition' => FormDefinition::find(1)->definition, // get some definition JSON
            'data' => FormSubmission::find(1)->data, // get some submission JSON
        ]);
    }
}
