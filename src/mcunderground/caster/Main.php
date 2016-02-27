<?php

namespace mcunderground\caster;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {
    public $configFile;

    public function onEnable()
{
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->configFile = (new Config($this->getDataFolder()."config.yml", Config::YAML, array(
            "prefix" => "Broadcast",
            "messageColor" => "§f",
            "firstBColor"=> "§0",
            "secondBColor" => "§0",
            "prefixColor" => "§6",
            "1Symbol" => "[",
            "2Symbol" => "]"
        )))->getAll();
        $this->getLogger()->info("[Caster] Loaded!");
    }



    public function onCommand(CommandSender $sender, Command $command, $label, array $args)
{
        switch($command->getName()){
            case "cast":
                if (isset($args[0])) {
                    Server::getInstance()->broadcastMessage($this->configFile["firstBColor"].$this->configFile["1Symbol"].$this->configFile["prefixColor"].$this->configFile["prefix"].$this->configFile["secondBColor"].$this->configFile["2Symbol"]." ".$this->configFile["messageColor"].implode(" ", $args));
                }
                else {
                    $sender->sendMessage("§4[Caster] §eUsage /cast (message).");

                }
                break;
        }

    }




    public function onDisable(){
        $this->getLogger()->info("[Caster] Disabled!");

    }


}
