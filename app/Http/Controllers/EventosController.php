<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventosRequest;
use App\Http\Requests\UpdateEventosRequest;
use App\Repositories\EventosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Lib\functions;

class EventosController extends AppBaseController
{
    /** @var  EventosRepository */
    private $eventosRepository;

    public function __construct(EventosRepository $eventosRepo)
    {
        $this->eventosRepository = $eventosRepo;
    }

    /**
     * Display a listing of the Eventos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = \Auth::user();
        //$request->id_user=$user->id;
        $this->eventosRepository->pushCriteria(new RequestCriteria($request));
        $eventos = $this->eventosRepository->findWhere([
            //Default Condition =
            'id_user'=>$user->id]);

        return view('eventos.index')
            ->with('eventos', $eventos);
    }

    /**
     * Show the form for creating a new Eventos.
     *
     * @return Response
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Store a newly created Eventos in storage.
     *
     * @param CreateEventosRequest $request
     *
     * @return Response
     */
    public function store(CreateEventosRequest $request)
    {
        $user = \Auth::user();
        //dd($user->id);
        $request->fechaincio = functions::uf_convertirdatetobd($request->fechaincio);
        $request->fechafin = functions::uf_convertirdatetobd($request->fechafin);
        //$request->id_user=1;
        //dd($request->id_user);
        $input = $request->all();
        $input['id_user']=$user->id;
        $eventos = $this->eventosRepository->create($input);

        Flash::success('Evento guardado Exitosamente.');

        return redirect(route('eventos.index'));
    }

    /**
     * Display the specified Eventos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $eventos = $this->eventosRepository->findWithoutFail($id);

        if (empty($eventos)) {
            Flash::error('Eventos not found');

            return redirect(route('eventos.index'));
        }

        return view('eventos.show')->with('eventos', $eventos);
    }

    /**
     * Show the form for editing the specified Eventos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $eventos = $this->eventosRepository->findWithoutFail($id);

        if (empty($eventos)) {
            Flash::error('Eventos not found');

            return redirect(route('eventos.index'));
        }

        return view('eventos.edit')->with('eventos', $eventos);
    }

    /**
     * Update the specified Eventos in storage.
     *
     * @param  int              $id
     * @param UpdateEventosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventosRequest $request)
    {
        $eventos = $this->eventosRepository->findWithoutFail($id);

        if (empty($eventos)) {
            Flash::error('Eventos not found');

            return redirect(route('eventos.index'));
        }

        $eventos = $this->eventosRepository->update($request->all(), $id);

        Flash::success('Eventos updated successfully.');

        return redirect(route('eventos.index'));
    }

    /**
     * Remove the specified Eventos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $eventos = $this->eventosRepository->findWithoutFail($id);

        if (empty($eventos)) {
            Flash::error('Eventos not found');

            return redirect(route('eventos.index'));
        }

        $this->eventosRepository->delete($id);

        Flash::success('Eventos deleted successfully.');

        return redirect(route('eventos.index'));
    }
}
