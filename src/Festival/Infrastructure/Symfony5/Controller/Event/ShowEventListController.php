<?php

namespace Symfony5\Controller\Event;

use Festival\Domain\Event\UseCase\ShowEventList\ShowEventList;
use Festival\Domain\Event\UseCase\ShowEventList\ShowEventListRequest;
use Festival\Presentation\Event\Presenter\ShowEventListJsonPresenter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony5\View\Event\ShowEventListView;

/**
 * @Route("/event", methods={"GET"})
 */
class ShowEventListController
{
    public function __invoke(
        ShowEventList $showEventList,
        ShowEventListJsonPresenter $eventListPresenter,
        ShowEventListView $eventListView
    )
    {
        $showEventList->execute(new ShowEventListRequest(), $eventListPresenter);
        return $eventListView->generateView($eventListPresenter->viewModel());
    }
}