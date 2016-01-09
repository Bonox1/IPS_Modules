<?

	class RSL366FunkDevice extends IPSModule
	{

		public function __construct($InstanceID)
		{
			//Never delete this line!
			parent::__construct($InstanceID);
			
			//These lines are parsed on Symcon Startup or Instance creation
			//You cannot use variables here. Just static values.
			$this->RegisterPropertyInteger("systemcode", 1);
			$this->RegisterPropertyInteger("programcode", 1);
			$this->RegisterPropertyInteger("retries", 4);
			$this->RegisterPropertyString("protokoll", "rsl366");
			
		}
		

		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
// 			$this->RegisterProfileIntegerEx("Status.SONOS", "Information", "", "", Array(
// 				Array(0, "Prev", "", -1),
// 				Array(1, "Play", "", -1),
// 				Array(2, "Pause", "", -1),
// 				Array(3, "Next", "", -1)
// 			));
// 			$this->RegisterProfileInteger("Volume.SONOS", "Intensity", "", " %", 0, 100, 1);
			
			$this->RegisterVariableBoolean("status", "Status", "Switch");
			$this->EnableAction("status");

			
		}


		public function Schalten ($value) {
			$proto=$this->ReadPropertyString("protokoll");
			$idValue=IPS_GetVariableIDByName("Status",$this->InstanceID);
			$value=getValue($idValue);
			$cmd="/usr/local/bin/pilight-send -p $proto";
// 			$idID=IPS_GetCategoryIDByName("ID",$inst);
// 			$idsId=IPS_GetChildrenIDs($idID);
// 			foreach($idsId as $ix=>$id) {
// 				$name=IPS_GetName($id);
// 				$parm=getValue($id);
// 				$cmd.=" --$name=$parm";
// 			}
			$val=$this->ReadPropertyInteger("programcode");
			$cmd.=" --programcode=$val";
			$val=$this->ReadPropertyInteger("systemcode");
			$cmd.=" --systemcode=$val";
			if ($value) {
				$value="-t";
			} else {
				$value="-f";
			}
			$cmd.=" $value";
			// pilight-send -p kaku_switch -i 1 -u 1 -t
			print_r("befehl=".$cmd."\n");
			//$rc = trim(@shell_exec("/usr/local/bin/pilight-send -p $proto -i $id -u $unit $value"));
			$retries=$this->ReadPropertyInteger("retries");
			for ($i = 1; $i <= $retries; $i++) {
				$rc = trim(@shell_exec($cmd));
			}
			
			
		}
		
// 		public function Pause()
// 		{
		
// 			include(__DIR__ . "/sonos.php");
// 			(new PHPSonos($this->ReadPropertyString("IPAddress")))->Pause();
			
// 		}
		
// 		public function Previous()
// 		{
		
// 			include(__DIR__ . "/sonos.php");
// 			(new PHPSonos($this->ReadPropertyString("IPAddress")))->Previous();
			
// 		}
		
// 		public function Next()
// 		{
		
// 			include(__DIR__ . "/sonos.php");
// 			(new PHPSonos($this->ReadPropertyString("IPAddress")))->Next();
			
// 		}
		
// 		public function SetVolume($volume)
// 		{
		
// 			include(__DIR__ . "/sonos.php");
// 			(new PHPSonos($this->ReadPropertyString("IPAddress")))->SetVolume($volume);
			
// 		}
		
// 		public function RequestAction($Ident, $Value)
// 		{
			
// 			switch($Ident) {
// 				case "Status":
// 					switch($Value) {
// 						case 0: //Prev
// 							$this->Previous();
// 							break;
// 						case 1: //Play
// 							$this->Play();
// 							SetValue($this->GetIDForIdent($Ident), $Value);
// 							break;
// 						case 2: //Pause
// 							$this->Pause();
// 							SetValue($this->GetIDForIdent($Ident), $Value);
// 							break;
// 						case 3: //Next
// 							$this->Next();
// 							break;
// 					}
// 					break;
// 				case "Volume":
// 					$this->SetVolume($Value);
// 					SetValue($this->GetIDForIdent($Ident), $Value);
// 					break;
// 				default:
// 					throw new Exception("Invalid ident");
// 			}
		
// 		}
		
// 		//Remove on next Symcon update
// 		protected function RegisterProfileInteger($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize) {
		
// 			if(!IPS_VariableProfileExists($Name)) {
// 				IPS_CreateVariableProfile($Name, 1);
// 			} else {
// 				$profile = IPS_GetVariableProfile($Name);
// 				if($profile['ProfileType'] != 1)
// 					throw new Exception("Variable profile type does not match for profile ".$Name);
// 			}
			
// 			IPS_SetVariableProfileIcon($Name, $Icon);
// 			IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
// 			IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
			
// 		}
		
// 		protected function RegisterProfileIntegerEx($Name, $Icon, $Prefix, $Suffix, $Associations) {
		
// 			$this->RegisterProfileInteger($Name, $Icon, $Prefix, $Suffix, $Associations[0][0], $Associations[sizeof($Associations)-1][0], 0);
		
// 			foreach($Associations as $Association) {
// 				IPS_SetVariableProfileAssociation($Name, $Association[0], $Association[1], $Association[2], $Association[3]);
// 			}
			
// 		}
		
	
	}

?>
