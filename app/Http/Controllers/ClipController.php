<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClipRequest;
use App\Http\Requests\UpdateClipRequest;
use App\Repositories\ClipRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Clip;
use DB;
use Storage;
use File;
use Validator;
use App\Mail\MailClass;
use App\Mail\MailClassDel;
use Mail;

class ClipController extends AppBaseController
{
    /** @var  ClipRepository */
    private $clipRepository;

    public function __construct(ClipRepository $clipRepo)
    {
        $this->clipRepository = $clipRepo;
    }

    /**
     * Display a listing of the Clip.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->clipRepository->pushCriteria(new RequestCriteria($request));
        $clips = $this->clipRepository->all();

        return view('clips.index')
            ->with('clips', $clips);
    }

    /**
     * Show the form for creating a new Clip.
     *
     * @return Response
     */
    public function create()
    {   
        //dd("hi");
        // return view('clips.create');
        return view('frontend.create');
    }

    /**
     * Store a newly created Clip in storage.
     *
     * @param CreateClipRequest $request
     *
     * @return Response
     */
    public function store(CreateClipRequest $request)
    {
            if ($request->isMethod('post'))
            {

                $input = $request->all();
                $clipName = $input['name'];
                
                // Пользовательские сообщения при ошибках
                $user_messages = [
                  'required' => 'Пожалуйста загрузите ролик',
                  'max' => 'Поле :attribute не должно превышать :max ',
                ];

                $validator = Validator::make( $input, [

                    'name' => 'required | max: 255',
                    'path' => 'required | max: 102400'

                ], $user_messages );

            if( $validator->fails() ){

              return redirect()->route( 'clips.create' )->withErrors( $validator )->withInput();

            }

            if (request()->hasFile('path'))
            {
                // Получаею экземпляр UploadedFile, получаю данные из полей path & name
                $file = $request->file('path', 'name');

                // Получаю оригинальное имя файла и присваиваю сгенерированный уникальный name через подчеркивание и присваиваю все в поле path
                $input['path'] = uniqid() . "_" . $file->getClientOriginalName();
            }

            // Получаю миме тип загружаемого файла
            $mime = $file->getClientMimeType();

            if ($mime != "video/mp4" && $mime != "video/avi")
            {
              Flash::error('Пожалуйста  загрузите файл формата .avi или .mp4');
              return view('frontend.create');
            }

            else
            {
              //Двигаю полученный видео файл в определенный каталог
              $file->move( public_path().'/uploads/clips', $input['path'] );
              // Сохраняю полученные данные в таблицу
              $clip = Clip::create(array(
                'name' => $input['name'],
                'path' => $input['path'],
                'mime' => $mime
              ));

              if ( $clip->save() )
              {
                  //$clip = $this->clipRepository->create($input);
                  Mail::to('advanced315@gmail.com')->send(new MailClass($clipName));

                  Flash::success('Клип : ' . $clip->name . " успешно сохранен.");

                  return redirect('/');
                  // return redirect(route('clips.index'));

              }
            }
            
        }
    }

    /**
     * Display the specified Clip.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clip = $this->clipRepository->findWithoutFail($id);

        if (empty($clip)) {
            Flash::error('Clip not found');

            return redirect(route('clips.index'));
        }

        return view('clips.show')->with('clip', $clip);
    }

    /**
     * Show the form for editing the specified Clip.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clip = $this->clipRepository->findWithoutFail($id);

        if (empty($clip)) {
            Flash::error('Clip not found');

            return redirect(route('clips.index'));
        }

        return view('clips.edit')->with('clip', $clip);
    }

    /**
     * Update the specified Clip in storage.
     *
     * @param  int              $id
     * @param UpdateClipRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClipRequest $request)
    {
        $clip = $this->clipRepository->findWithoutFail($id);

        if (empty($clip)) {
            Flash::error('Clip not found');

            return redirect(route('clips.index'));
        }

        $clip = $this->clipRepository->update($request->all(), $id);

        Flash::success('Clip updated successfully.');

        return redirect(route('clips.index'));
    }

    /**
     * Remove the specified Clip from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $Request)
    {
        $clip = $this->clipRepository->findWithoutFail($id);

        if (empty($clip)) {
            Flash::error('Ошибка: клип не найден');

            return redirect('/');
        }

        if ($Request->isMethod('DELETE'))
        {

          //dd($Request);
          //$this->clipRepository->destroy($id);

          // Получаю старый путь файла по его id
          $path_old = Clip::find($id);
          // Получаю старое имя файла
          $filename_old = $path_old->path;
          // Почучаю полный путь до удаляемого файла
          $path = public_path().'/uploads/clips/';
          //dd($path);
          // Удаляю файл из каталога, передаю в метод полный путь и имя файла
          unlink($path . $filename_old);
          //dd($myFile);
          // Нахожу удалямый файл по id
          $clip = Clip::find($id);
          $clipName = $clip->name;
          // Удаляю файл из БД.
          $clip->delete();

          Mail::to('advanced315@gmail.com')->send(new MailClassDel($clipName));

          Flash::success('Клип c названием: '.$clip->name.' успешно удален');

          return redirect('/');
        }
        
    }
}
