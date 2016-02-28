<?php

namespace mcunderground\caster;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\event\Listener;

class welcome extends PluginBase implements Listener {

    public function onEnable(){
         $this->getServer()->getPluginManager()->registerEvents($this), $this);
         @mkdir($this->getDataFolder());
         
       $this->configFile = new Config($this->getDataFolder()."welcomeConfig.yml", Config::YAML, array(
        "owner" => "Owner",
        "welcomeMessage" => "My Server",
        ));
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
         $player->sendMessage($this->configFile["welcomeMessage"]);
       }   
    }
