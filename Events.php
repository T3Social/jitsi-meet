<?php

namespace humhubContrib\modules\jitsiMeet;

use humhub\modules\ui\menu\MenuLink;
use humhub\widgets\TopMenu;
use humhubContrib\modules\jitsiMeet\permissions\CanAccess;
use Yii;

class Events
{
    public static function onTopMenuInit($event)
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->can(CanAccess::class)) {
            return;
        }

        /** @var TopMenu $topNav */
        $topNav = $event->sender;

        /** @var Module $module */
        $module = Yii::$app->getModule('jitsi-meet');

        $topNav->addEntry(new MenuLink([
            'label' => Yii::t('JitsiMeetModule.base', $module->getSettingsForm()->menuTitle),
            'url' => ['/jitsi-meet/room'],
            'icon' => 'video-camera',
            'isActive' => MenuLink::isActiveState('jitsi-meet', 'room'),
            'sortOrder' => 400,
        ]));
    }

}
