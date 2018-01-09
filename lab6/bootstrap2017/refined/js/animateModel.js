//Javascript function to trigger animation of the 3D model
function animateModel(){
    if(document.getElementById('bowl__GrpBowl-TIMER').getAttribute('enabled')!= 'true')
         document.getElementById('bowl__GrpBowl-TIMER').setAttribute('enabled', 'true');
     else
         document.getElementById('bowl__GrpBowl-TIMER').setAttribute('enabled', 'false');
}