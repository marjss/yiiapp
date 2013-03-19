<?php
class TestCommand extends CConsoleCommand
{
   public function run($args)
   {
		$myFile = "action.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		
		$stringData .=  "Action Name: "."\n";
		
		if($args[0] == 'datetime')
		{
			$stringData = "------------------------------------------------------- \n";
			fwrite($fh, $stringData);
			$stringData = "------------------------------------------------------- \n";
			$stringData .= "\n";
			fwrite($fh, $stringData);
		}
		
		
		
		
		fclose($fh);
   }
}