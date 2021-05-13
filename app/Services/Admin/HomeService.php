<?php

namespace App\Services\Admin;

use App\Models\Visitors;
use App\Models\User;
use App\Models\Page;

class HomeService
{

    private $modelVisitors;
    private $modelUser;
    private $modelPage;

    public function __construct(Visitors $visitors, User $user, Page $page)
    {
        $this->modelVisitors = $visitors;
        $this->modelUser = $user;
        $this->modelPage = $page;
    }

    public function index()
    {

        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;

        $visitsCount = $this->modelVisitors->count();
        $pageCount   = $this->modelPage->count();
        $userCount   = $this->modelUser->count();

        /* Visitantes Online */
        $datelimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = $this->modelVisitors->select('ip')->where('created_at', '>=', $datelimit)->groupBy('ip')->get();

        $onlineCount = count($onlineList);

        /* Gráficos */
        $pagePie = [];

        $visitsAll = $this->modelVisitors->selectRaw('page, count(page) as c')->groupBy('page')->get();

        foreach ($visitsAll as $visit) {
            $pagePie[$visit['page']] = intval($visit['c']);
        }

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));

        return view('admin.home', [
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount'   => $pageCount,
            'userCount'   => $userCount,
            'pageLabels'  => $pageLabels,
            'pageValues'  => $pageValues
        ]);
    }
}
