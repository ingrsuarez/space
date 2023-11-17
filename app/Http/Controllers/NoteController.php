<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Note;
use App\Models\Institution;

class NoteController extends Controller
{
    //
    public function create()
    {
        $user = Auth::user();
        $users = $user->currentInstitution->users()->get();
        $institution = $user->currentInstitution;
        
        if($user->hasRole('profesional'))
        {
            $notes = DB::table('notes')
                ->join('users','notes.user_id','users.id')
                ->select('notes.id as note_id','notes.title','notes.note','notes.created_at','notes.user_id','notes.creator_id',
                'users.name','users.lastName')
                ->where('user_id',$user->id)
                ->get();

            // return $notes;
        }else{
            $notes = DB::table('notes')
                ->join('institution_user','notes.user_id','institution_user.user_id')
                ->join('users','notes.user_id','users.id')
                ->where('institution_user.institution_id',$institution->id)
                ->select('notes.id as note_id','notes.title','notes.note','notes.created_at','notes.user_id','notes.creator_id',
                'users.name','users.lastName')
                ->get();
            
            // SELECT *
            // FROM notes
            // INNER JOIN institution_user
            // ON notes.user_id = institution_user.user_id
            // WHERE institution_user.institution_id = 1
        }

        return view('notes.create',compact('user','users','institution','notes'));
    }

    public function store(Request $request)
    {
        $creator = Auth::user();

        $note = new Note;
        $note->title = $request->title;
        $note->note = $request->note;
        $note->user_id = $request->professional;
        $note->creator_id = $creator->id;
        $note->type = 'calendar';
        $note->status = 'active';

        $note->save();
        return back()->with('success', 'Nota creada correctamente!');
        
    }

    public function delete(Note $note)
    {
        $user = Auth::user();
        $creator = User::where('id',$note->creator_id)->first();
        if(!$creator->hasRole('profesional'))
        {
            $note->delete();
            return back()->with('success', 'Nota eliminada correctamente!');
        } 
        else
        {   
            if($user->id == $creator->id){
                $note->delete();
                return back()->with('success', 'Nota eliminada correctamente!');
            }
            return back()->with('success', 'Solo el profesional puede eliminar esta nota!');
        }
            
    }

    public function read(Request $request)
    {
        $user = Auth::user();
        $institution = $user->currentInstitution;
        if ($request->session()->has('notes')) {
            // return request()->session()->get('notes');
            $stored_notes = request()->session()->get('notes');
            if (!in_array($request->user_note, $stored_notes))
            {
                array_push($stored_notes,$request->user_note);
            }  
            request()->session()->put('notes',$stored_notes);
            return redirect()->route('appointment.index',['institution_id'=> $institution->id,'user_id'=>$request->user_note]);
        }else{
            $read_notes = ['0'=>$request->user_note];
            request()->session()->put('notes',$read_notes);
            return redirect()->route('appointment.index',['institution_id'=> $institution->id,'user_id'=>$request->user_note]);
        }   
        
    }
}
