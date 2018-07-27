<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return $students->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novoStudent = new Student;

        $novoStudent->id = $request->id;
        $novoStudent->boletim = $request->boletim;
        $novoStudent->cpf = $request->cpf;
        $novoStudent->nome = $request->nome;
        $novoStudent->telefone = $request->telefone;
        $novoStudent->endereco = $request->endereco;    
        $novoStudent->email = $request->email;

        $novoStudent->save();

        if(!Storage::exists('localPhotos/')) {
            Storage::makeDirectory('localPhotos/', 0775, true);

        //decodifica a string em base64 e a atribui a uma variável
        $image = base64_decode($request->foto);
        //gera um nome único para o arquivo e concatena seu nome com a
        //extensão ‘.png’ para termos de fato uma imagem
        $imgName = uniqid() . '.pdf';
        //atribui a variável o caminho para a imagem que é constituída do
        //caminho das pastas e o nome do arquivo
        $path = storage_path('/app/localPhotos/' . $imgName);
        //salva o que está na variável $image como o arquivo definido em $path
        file_put_contents($path,$image);
        $novoStudent->foto = $imgName;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        if($request->nome){
          $student->nome = $request->nome;
        }
        if($request->idade){
          $student->idade = $request->idade;
        }
        if($request->email){
          $student->email = $request->email;
        }
        if($request->cpf){
          $student->cpf = $request->cpf;
        }
        if($request->telefone){
          $student->telefone = $request->telefone;
        }
        if($request->boletim){
          $student->boletim = $request->boletim;
        }
        if($request->id){
          $student->id = $request->id;
        }

        $student->save();
        return response()->json('Estudante alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return response()->json('Estudante deletado com sucesso!');
    }
}
