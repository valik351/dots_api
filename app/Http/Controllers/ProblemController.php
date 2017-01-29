<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Returns a problem's archive
     * 
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function getArchive(Request $request, $id)
    {
        return response()->download(Problem::findOrFail($id)->getArchivePath());
    }

    public function index(Request $request)
    {
        $orderBySession = \Session::get('orderBy', 'updated_at');
        $orderBy = $request->input('order', $orderBySession);

        $orderDirSession = \Session::get('orderDir', 'desc');
        $orderDir = $request->input('dir', $orderDirSession);

        $page = $request->input('page');
        $query = $request->input('query', '');

        if (!in_array($orderBy, Problem::sortable())) {
            $orderBy = 'id';
        }

        if (!in_array($orderDir, ['asc', 'ASC', 'desc', 'DESC'])) {
            $orderDir = 'desc';
        }

        \Session::put('orderBy', $orderBy);
        \Session::put('orderDir', $orderDir);

        $problems = $this->findQuery();

        if ($query) {
            $problems = $problems->where(function ($query_s) use ($query) {
                $query_s->orwhere('id', 'like', "%$query%")
                    ->orwhere('name', 'like', "%$query%");
            });
        }

        $problems = $problems->orderBy($orderBy, $orderDir)
            ->paginate(10);

        return view('problems.list')->with([
            'problems' => $problems,
            'order_field' => $orderBy,
            'dir' => $orderDir,
            'page' => $page,
            'query' => $query
        ]);
    }

    /**
     * Show the form.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $id
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm(Request $request, $id = null)
    {
        $problem = ($id ? $this->findOrFail($id) : new Problem());
        if ($id) {
            $title = 'Edit Problem';
        } else {
            $title = 'Create Problem';
        }

        return view('problems.form')->with([
            'problem' => $problem,
            'title' => $title
        ]);
    }

    /**
     * Handle a add/edit request
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        $problem = (!$id ?: $this->findOrFail($id));

        $this->validate($request, Problem::getValidationRules());

        $fillData = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'difficulty' => $request->get('difficulty'),
        ];
        if ($id) {
            $problem->fill($fillData);
        } else {
            $problem = new Problem($fillData);
            $problem->save();
        }

        if ($request->hasFile('archive')) {
            $problem->setArchive('archive');
        }

        if ($request->hasFile('image')) {
            $problem->setImage('image');
        }

        if($request->has('volumes')) {
            $problem->volumes()->sync($request->get('volumes'));
        } else {
            $problem->volumes()->sync([]);
        }
        $problem->save();

        \Session::flash('alert-success', 'The problem was successfully saved');
        return redirect()->route('problems::list');
    }

    /**
     * Handle a delete request
     *
     * @param int|null $id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $problem = $this->findOrFail($id);
        $problem->delete();
        return redirect()->route('problems::list')->with('alert-success', 'The problem was successfully deleted');
    }

    /**
     * Handle a restore request
     *
     * @param int|null $id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $problem = $this->findOrFail($id);
        $problem->restore();
        return redirect()->route('problems::list')->with('alert-success', 'The problem was successfully restored');
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    protected function findQuery()
    {
        return Problem::withTrashed();
    }

    protected function findOrFail($id)
    {
        return $this->findQuery()->findOrFail($id);
    }
}
 