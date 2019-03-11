<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ThemeController extends ControllerBase
{
    /**
     * Searches for user
     */
    public function changeAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $theme = $this->request->getPost('theme');
            $this->flash->notice('Вы поменяли тему визуального оформления на: '.$theme.'.');
            $this->cookies->set(
                'contracts-theme',
                $theme,
                time() + 15 * 86400
            );
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        }
    }
}
