<?php
/*
	@type: CLASS
	@author: MARIZ MELO
	@description: Debug system, this class is inherited by all classes on the framework
*/
//warning messages stylesheet and 64 images
define("DEBUG_STYLE", '<style type="text/css">.xc_debug{font-family:Arial,"Verdana";font-size:12px}.alert_success,.alert_error,.alert_help,.alert_warning{padding:10px;margin:3px;padding-left:35px;border:solid 1px;background-repeat:no-repeat;background-position:7px 9px;line-height:20px;z-index:2147483647}.alert_success{background-image:url(data:image/gif;base64,R0lGODlhFAAUAMQbAMbzxXHJYE29OcfqwCquEKznp2vLXK/oqm7MXuP04FW+QES5LiqtEDi0ILPrryGqBSitDdXv0Eu8No7UgDizIPL68B6pA7HqrD22Jv///xyoAOL/5QAAAAAAAAAAAAAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4wLWMwNjAgNjEuMTM0Nzc3LCAyMDEwLzAyLzEyLTE3OjMyOjAwICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpGMjcyNDNCQ0NERjAxMURGQTA1MEYxNEIzODkyQTQ4RCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpGMjcyNDNCRENERjAxMURGQTA1MEYxNEIzODkyQTQ4RCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkUzQUNDNEUxQ0RGMDExREZBMDUwRjE0QjM4OTJBNDhEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkUzQUNDNEUyQ0RGMDExREZBMDUwRjE0QjM4OTJBNDhEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAQAAGwAsAAAAABQAFAAABYjgJo5kaZaFsVjaYhTnCAhabdcCcDrE7WsERwnQ+/kIuhHNWBtkAhrB6MCsKTIJ20GEqGqc0BpC1KgGsLeG6HFTMGyJjOL2EEFqk0wm8j4PfHUbGDdnfHFzaVw+ZxUZfz5jG1SLAwMUP1siS144JAB3nBBJIzxeBBcnABJMEqMnKQs1LjAxtTEhADs=);border-color:#66b566;color:green;background-color:#e2ffe5}.alert_success a{color:green;text-decoration:underline}.alert_error{background-image:url(data:image/gif;base64,R0lGODlhFAAUAMQeAP/Cwv8gIP84OP8tLf+oqP+lpf9dXf9aWv+AgP/w8P+trf9AQP+goP/Q0P8FBf8NDf81Nf9QUP9gYP/AwP+QkP/g4P+wsP8lJf8DA/9wcP+qqv8QEP////8AAP/i4gAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4wLWMwNjAgNjEuMTM0Nzc3LCAyMDEwLzAyLzEyLTE3OjMyOjAwICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFM0FDQzRERkNERjAxMURGQTA1MEYxNEIzODkyQTQ4RCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFM0FDQzRFMENERjAxMURGQTA1MEYxNEIzODkyQTQ4RCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkUzQUNDNEREQ0RGMDExREZBMDUwRjE0QjM4OTJBNDhEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkUzQUNDNERFQ0RGMDExREZBMDUwRjE0QjM4OTJBNDhEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAQAAHgAsAAAAABQAFAAABZGgJ45kaZbFMWDdcBTnCAhdbdcCcCrb7XcbRQnQ+/k2uhHN+BOMCLcMh1GjTG8EkeEm4XAkES/iZhAFfAxvgmPxBUSOY8NbKdocosdxzUmcb3geFz4TfRUcDW5aNwheEQtiZCJQNoUUNY2JNlkiSx0BCzcLfx1OMnpMNg9JIzypQBonABBMEKwnKQM1LjAxvjEhADs=);border-color:#e98383;color:red;background-color:#ffe2e2}.alert_error a{color:red;text-decoration:underline}.alert_help{background-image:url(data:image/gif;base64,R0lGODlhFAAUAMQfAPr14f38+ufdveHXsuHXs/f17Pfw2vbw2ezkxuzjxuXcuvv69eTZtuvkzOHWseDVr/fx2+ffwuXcvfPv4e/q1+nhx+fdvOPZuPXy5vfx2vHs3O3n0t/Ur////9/Urv/66SH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4wLWMwNjAgNjEuMTM0Nzc3LCAyMDEwLzAyLzEyLTE3OjMyOjAwICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFM0FDQzREQkNERjAxMURGQTA1MEYxNEIzODkyQTQ4RCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFM0FDQzREQ0NERjAxMURGQTA1MEYxNEIzODkyQTQ4RCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkUzQUNDNEQ5Q0RGMDExREZBMDUwRjE0QjM4OTJBNDhEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkUzQUNDNERBQ0RGMDExREZBMDUwRjE0QjM4OTJBNDhEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAQAAHwAsAAAAABQAFAAABZjgJ45kaZZHonCekhznCAhebdcCcELD7XsDSAnQ+/kGuhHNVikEOoXGTTAy3BqdTuDZodwMIsRtAa0VOosbQsS4BRaXGgZ9Y4geNwKhNsl6bQ8iDkZ9HRo+gR9xPhJZUj52H2I+EWU/ax9WPxt7P2AiSzaVAZ02VDKDTFqlHg5JIzw3Eos1AxknABZGHhavJykKNS4wMcUxIQA7);border-color:#cec5a6;color:#bdb59c;background-color:#fffae9}.alert_help a{color:#bdb59c;text-decoration:underline}.alert_warning{background-image:url(data:image/gif;base64,R0lGODlhFAAUALMPAPzupf75y/rhfPrkhPvnj/zrm/3ysvndbP73w/71vPnfc/vok//81Pvmivncav/92CH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4wLWMwNjAgNjEuMTM0Nzc3LCAyMDEwLzAyLzEyLTE3OjMyOjAwICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M1IE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo3RjlBMDc3RURFNDkxMURGOEVERkY5RTc1MjcxNjlDMCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo3RjlBMDc3RkRFNDkxMURGOEVERkY5RTc1MjcxNjlDMCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjdGOUEwNzdDREU0OTExREY4RURGRjlFNzUyNzE2OUMwIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjdGOUEwNzdEREU0OTExREY4RURGRjlFNzUyNzE2OUMwIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAQAADwAsAAAAABQAFAAABIXwyUmrtUGcQ9i9hSM6xlcligAUaWBKDEFKgAN4pnE4iGQ4it4nMBCVHjXHAmdJ2h6MkOOQuCAEowJUJmowYVIR4UEczSgoswBhUKhdMO7o0CiaHVrfHR9ANO5BD1d7cD93DQlyZgBQC3sOdY8KdTt7AgZYj5oDNwYNn6ChogQGXy+nqBMRADs=);border-color:#f9dc6a;color:#F9CC6A;background-color:#fffdd8}.alert_warning a{color:#d5c06c;text-decoration:underline}.alert_opaque{-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity=50);-khtml-opacity: 0.5;-moz-opacity: 0.5;opacity: 0.5;}</style>');


abstract class Debug{
	
	
	private $_XDEBUG = 0;
	
	
	
	public function debugLOG()
	{
	  $bt = debug_backtrace();
	  $caller = array_shift($bt);
	
	   echo $caller['file']." ".$caller['line'];
	
	  // do your logging stuff here.    
	}
	
	
	public function superHelp(){	
	
		$HELP  = '	
		<br />
		<b>type:</b>		DEBUG "abstract" Class <br />
		<b>author:</b>		Mariz Melo <br />
		<b>released:</b>	10-11-2010 <br />
		<b>description:</b>	<i>"Provide methods to control DEBUG system messages"</i> <br />
		<br />
		METHODS: <b>debugSTART</b>( (int) 1 ) //just set 1 if want to see the PHP messages<br />
		ex: $instance_var->debugSTART(); //only the system messages<br />
		ex: $instance_var->debugSTART(); //initialize only the system messages<br />
		';//end:HELP
		
		
		$this->debugMESSAGE('H', $HELP); //show help message
		return '';
		
	}
	
	
	
	//START THE DEBUG MESSAGES
	public function debugSTART($phperror = 0){
		
		echo DEBUG_STYLE;	//put the styles for the debug systems
		
		//PHP SYSTEM ERROR MESSAGES
		if ($phperror == 1) {
			
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
			
		}		
			
		//START TO SHOW SYSTEM MESSAGES
		$this->_XDEBUG = 1; //set the object variable to 1 allowing the system report messages
		
	}//end: method
	
	
	
	
	//SHOW DEBUG MESSAGES: ARGUMENT VALUES: 'E' - error, 'S' - success, or 'H' - help
	public function debugMESSAGE($chType=0, $strMsg=0, $strLineFile=0){
		
		//verify here the debug variable
		if($this->_XDEBUG){
		
			switch($chType){
				case 'H':
					echo "<div class='alert_help xc_debug'><b>HELP:</b> {$strMsg}</div>";
					break;
				case 'S':
					echo "<div class='alert_success xc_debug'><b>SUCCESS:</b> {$strMsg}</div>";	
					break;
				case 'E':
					echo "<div class='alert_error xc_debug'><b>ERROR:</b> {$strMsg}</div>";	
					break;
				case 'W':
					echo "<div class='alert_warning xc_debug'><b>WARNING:</b> {$strMsg}</div>";	
					break;
				
			}//end:switch
		
		}//end:if
		
	}//end:method
	
	
}//class


?>