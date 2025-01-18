<?php

namespace App\Http\Controllers\Dashboard\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\StudentPromotionRepositoryInterface;

class PromotionController extends Controller
{
    protected $Promotion;
    public function __construct(StudentPromotionRepositoryInterface $Promotion)
    {
        $this->Promotion = $Promotion;
    }

    public function index()
    {
        return $this->Promotion->index();
    }


    public function create()
    {
        return $this->Promotion->create();
    }


    public function store(Request $request)
    {
        return $this->Promotion->store($request);
    }

    public function destroy($id)
    {
        return $this->Promotion->destroy($id);

    }
    public function destroyAllStudents()
    {
        return $this->Promotion->destroyAllStudents();
    }
}
