<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admins.members.index', [
            'members' => Member::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'f_nama' => "required",
            'f_username' => "required|unique:t_anggota,f_username",
            'f_password' => 'required|min:6',
            'f_tempatlahir' => 'required',
            'f_tanggallahir' => 'required|date'
        ]);

        $request->validate([
            'f_confirmPassword' => 'required|same:f_password'
        ]);

        $validated['f_password'] = bcrypt($validated['f_password']);

        $member = Member::create($validated);
        if (!$member) {
            return redirect('/dashboard/members')->with('notify', 'Gagal Registrasi Anggota');
        }
        return redirect('/dashboard/members')->with('notify', "Berhasil Registrasi Anggota " . $member->f_nama);
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('admins.members.edit', [
            'member' => $member
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $rules = [
            'f_nama' => 'required',
            'f_tempatlahir' => 'required',
            'f_tanggallahir' => 'required|date'
        ];

        if ($request->input('f_username') != $member->f_username) {
            $rules['f_username'] = 'required|unique:t_anggota,f_username';
        }

        $validated = $request->validate($rules);

        $updateMember = $member->update($validated);

        if (!$updateMember) {
            return redirect('/dashboard/members')->with('notify', 'Gagal Mengedit Data Member');
        }
        return redirect("/dashboard/members")->with('notify', 'Berhasil Mengedit Data Member ' . $member->f_nama);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $deletedMember = $member->delete();
        if (!$deletedMember) {
            return redirect('/dashboard/members')->with('notify', 'Gagal Menghapus Member');
        }
        return redirect('/dashboard/members')->with('notify', 'Berhasil Menghapus Member ' . $member->f_nama);
    }

    public function editPwView(Member $member)
    {
        return view('admins.members.editPassword', [
            'member' => $member
        ]);
    }

    public function editPw(Member $member, Request $request)
    {
        $validated = $request->validate([
            'f_password' => 'required|min:6',
            'f_confirmPassword' => 'required|same:f_password'
        ]);

        $newPassword = bcrypt($validated['f_password']);

        $newMember = [
            'f_nama' => $member->f_nama,
            'f_username' => $member->f_username,
            'f_password' => $newPassword,
            'f_tempatlahir' => $member->f_tempatlahir,
            'f_tanggallahir' => $member->f_tanggallahir
        ];

        $updatedMember = $member->update($newMember);

        if (!$updatedMember) {
            return redirect('/dashboard/members')->with('notify', 'Gagal Mengubah Password');
        }
        return redirect('/dashboard/members')->with('notify', 'Berhasil Mengubah Password Member ' . $member->f_nama);
    }
}
