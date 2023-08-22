<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function maanSkill()
    {
        $skills = Skill::latest()->paginate(10);
        return view('admin.pages.skill.skill', compact('skills'));
    }

    public function maanNewSkill(Request $request)
    {
        $request->validate([
            'title'          => 'required',
            'description'    => 'required',
            'bigimage'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            'smallimage'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',

        ]);
        Skill ::addSkill($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteSkill($id)
    {
        $this->skill = Skill::find($id);
        if (file_exists($this->skill->bigimage)) {
            unlink($this->skill->bigimage);
        }
        if (file_exists($this->skill->smallimage)) {
            unlink($this->skill->smallimage);
        }
        $this->skill->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanSkillStatus($id)
    {
        $this->statusSkill = Skill::findOrFail($id);
        $this->statusSkill->status = $this->statusSkill->status == 1 ? 0 : 1;
        $this->statusSkill->save();
        return redirect()->back()->with('message','Status changed successfully');
    }
    public function maanEditSkill ($id)

    {
        return view('admin.pages.skill.edit_skill', [
            'info'      => Skill::find($id),
            'skills'    => Skill::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateSkill (Request $request, $id)
    {
        $request->validate([
            'title'          => 'required',
            'description'    => 'required',
        ]);
        if ($request->bigimage) {
            $request->validate([
                'bigimage'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800'
            ]);
        }
        if ($request->smallimage) {
            $request->validate([
                'smallimage'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800'
            ]);
        }
        Skill::updateSkill($request, $id);
        return redirect('/skill')->with('message', 'Data updated successfully.');
    }
}
