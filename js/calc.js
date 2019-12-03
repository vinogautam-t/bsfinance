function calcthis(a)
{ 
var perc = document.getElementById("percent").value;
if (a==1) { 
if (perc == "perc1") {document.getElementById('ress').innerHTML="Your <b>Profit</b> after 1 day";};
if (perc == "perc2") {document.getElementById('ress').innerHTML="Your <b>Profit</b> after 3 days";};
if (perc == "perc3") {document.getElementById('ress').innerHTML="Your <b>Profit</b> after 7 days";};
if (perc == "perc4") {document.getElementById('ress').innerHTML="Your <b>Profit</b> after 15 days";};
if (perc == "perc5") {document.getElementById('ress').innerHTML="Your <b>Profit</b> after 30 days";};
if (perc == "perc6") {document.getElementById('ress').innerHTML="Your <b>Profit</b> after 50 days";};
if (perc == "perc7") {document.getElementById('ress').innerHTML="Your <b>Profit</b> after 30 days";};
if (perc == "perc8") {document.getElementById('ress').innerHTML="Your <b>Profit</b> after 50 days";};
}
var planperc=new Array(0,0,0,0,0,0);
var depo = document.getElementById("deposit").value;
if (perc == "perc1") {planperc=Array(142, 142, 142); min=10; max=10000;};
if (perc == "perc2") {planperc=Array(187.5, 187.5, 187.5); min=20000; max=50000;};
if (perc == "perc3") {planperc=Array(292.5, 292.5, 292.5); min=50000; max=200000;};
if (perc == "perc4") {planperc=Array(655 , 655 , 655); min=7000; max=150000;};
if (perc == "perc5") {planperc=Array(1500 , 1500 , 1500); min=2500; max=50000;};
if (perc == "perc6") {planperc=Array(3000 , 3000 , 3000); min=1000; max=25000;};
if (perc == "perc7") {planperc=Array(555 , 555 , 555); min=25000; max=300000;};
if (perc == "perc8") {planperc=Array(1555 , 1555 , 1555); min=14000; max=50000;};
if (perc == "perc9") {planperc=Array(6500 , 6500 , 6500); min=500; max=15000;};
if (perc == "perc10") {planperc=Array(16000 , 16000 , 16000); min=500; max=10000;};
	if (depo < min)
  {
	document.getElementById("inpvar1").innerHTML = "n/a</span>";
	document.getElementById("inpvar2").innerHTML = "<span class=\"upperc\" style=\"margin:15px 5px;display:inline-block;font-size:110%\">n/a";						
	alert ("Minimal deposit is $"+min);	
  } 
else
if (depo > max)
  {
	document.getElementById("inpvar1").innerHTML = "n/a</span>";
	document.getElementById("inpvar2").innerHTML = "<span class=\"upperc\" style=\"margin:15px 5px;display:inline-block;font-size:110%\">n/a";						
	alert ("Maximal deposit is $"+max);	
  } 
else
  {
	  if(perc == "perc1"){
	  	document.getElementById("inpvar1").innerHTML = " ("+ planperc[0] + "%)";
	  	document.getElementById("inpvar2").innerHTML = "<h5 style=\"margin:0px\">Calculation Result</h5><b>Daily returns:</b> $"+ depo * 2.1 / 100 +"<br><b>Final Returns:</b> $"+planperc[0] * depo / 100;
		if(perc == "perc1"){document.getElementById("inpvar3").innerHTML = "<br>Everyday accruals during 20 calendar days";}
	  }else
		if(perc == "perc2"){
			document.getElementById("inpvar1").innerHTML = " ("+ planperc[1] + "%)";
			document.getElementById("inpvar2").innerHTML = "<h5 style=\"margin:0px\">Calculation Result</h5><b>Daily returns:</b> $"+ depo * 2.3 / 100 +"<br><b>Final Returns:</b> $"+planperc[1] * depo / 100;
			if(perc == "perc2"){document.getElementById("inpvar3").innerHTML = "<br>Everyday accruals during 35 calendar days";}
		}else
			if(perc == "perc3"){
		  		document.getElementById("inpvar1").innerHTML = " ("+ planperc[2] + "%)</span>";
				document.getElementById("inpvar2").innerHTML = "<h5 style=\"margin:0px\">Calculation Result</h5><b>Daily returns:</b> $"+ depo * 3.3 / 100 +"<br><b>Final Returns:</b> $"+planperc[2] * depo / 100;
				if(perc == "perc3"){document.getElementById("inpvar3").innerHTML = "<br>Everyday accruals during 55 calendar days.";}
		  	}else
				if((perc == "perc4") || (perc == "perc5") || (perc == "perc6") || (perc == "perc7") || (perc == "perc8") || (perc == "perc9") || (perc == "perc10")){
		  			document.getElementById("inpvar1").innerHTML = " ("+ planperc[2] + "%)<br>includes your principal";
					document.getElementById("inpvar2").innerHTML = "<h5 style=\"margin:0px\">Calculation Result</h5><b>Final Returns:</b> $"+planperc[2] * depo / 100;
					if(perc == "perc4"){document.getElementById("inpvar3").innerHTML = "<br>After 25 calendar days";}
					if(perc == "perc5"){document.getElementById("inpvar3").innerHTML = "<br>After 45 calendar days";}
					if(perc == "perc6"){document.getElementById("inpvar3").innerHTML = "<br>After 60 calendar days";}
					if(perc == "perc7"){document.getElementById("inpvar3").innerHTML = "<br>After 11 calendar days";}
					if(perc == "perc8"){document.getElementById("inpvar3").innerHTML = "<br>After 24 calendar days";}
					if(perc == "perc9"){document.getElementById("inpvar3").innerHTML = "<br>After 90 calendar days";}
					if(perc == "perc10"){document.getElementById("inpvar3").innerHTML = "<br>After 160 calendar days";}
				}
  
  }

}