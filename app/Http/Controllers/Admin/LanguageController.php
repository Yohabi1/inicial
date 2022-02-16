<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Pranto\MultiLanguage\Models\Language;

class LanguageController extends Controller
{
    public function langManage($lang = false)
    {
        $lang_list = Language::all();
        return view('lang.lang', compact('lang_list'));
    }

    public function langStore(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required',
        ]);

        if ($request->code == 'en' || $request->code == 'EN'){
            return back()->with('alert', 'Default Language');
        }

        $data = file_get_contents(resource_path('/lang/default.json'));
        $json_file = $request->code.'.json';
        $path = resource_path('lang/'). $json_file;

        File::put($path, $data);

        $in['name'] = $request->name;
        $in['code'] = strtolower($request->code);
        Language::create($in);

        return back()->with('success', 'Create Successfully');
    }

    public function langUpdatepp(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $la = Language::whereId($id)->first();

        $in['name'] = $request->name;

        Language::whereId($id)->update($in);

        return back()->with('success', 'Update Successfully');
    }

    public function langDel($id)
    {
        $la = Language::find($id);
        @unlink(resource_path('lang/').$la->code.'.json');

        $la->delete();
        return back()->with('success', 'Delete Successfully');

    }

    public function langEdit($id)
    {
        $la = Language::find($id);
        $page_title = "Update ".$la->name." Keywords";
        $json = file_get_contents(resource_path('lang/').$la->code.'.json');
        $list_lang = Language::all();

        if (empty($json))
        {
            return back()->with('alert', 'File Not Found.');
        }

        return view('lang.edit_lang', compact('page_title', 'json', 'la','list_lang'));
    }

    public function langUpdate(Request $request, $id)
    {
        $lang = Language::find($id);
        $content = json_encode($request->keys);


        if ($content === 'null')
        {
            return back()->with('alert', 'At Least One Field Should Be Fill-up');
        }

        file_put_contents(resource_path('lang/'). $lang->code . '.json', $content);


        return back()->with('success', 'Update Successfully');
    }

    public function langImport(Request $request)
    {
        $lang = Language::find($request->code);
        $json = file_get_contents(resource_path('lang/').$lang->code.'.json');
        return $json;
    }

}
