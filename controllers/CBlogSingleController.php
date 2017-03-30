<?php

namespace bamboo\blog\controllers;

use bamboo\core\router\ARootController;
use bamboo\core\router\CInternalRequest;
use bamboo\core\router\CRootView;
use bamboo\core\theming\CWidgetHelper;

/**
 * Class CBlogSingleController
 * @package bamboo\front\site\controllers
 *
 * @author Bambooshoot Team <emanuele@bambooshoot.agency>
 *
 * @copyright (c) Bambooshoot snc - All rights reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * @date 18/04/2016
 * @since 1.0
 */

class CBlogSingleController extends ARootController
{
    /**
     * @param CInternalRequest $request
     * @return string
     * @throws \bamboo\core\exceptions\RedPandaInvalidArgumentException
     */
    public function get(CInternalRequest $request)
    {
        $view = new CRootView($request,$this->app->rootPath().$this->app->cfg()->fetch('paths','store-theme').'/pages/blogsingle.php');
        $view->setHeadTags($this->app->getBubbledObj('headTags'));

        return $view->render([
            'app' =>  new CWidgetHelper($this->app)
        ]);
    }
}