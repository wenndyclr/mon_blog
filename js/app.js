var textType = "« Je jure solennellement que mes intentions sont mauvaises »"
var textTypeCount = textType.split('');
console.log('textTypeCount');

var spaceTyping = document.getElementById('spaceTyping');

var animateText = () => {
	// var test = textTypeCount.length;
	// console.log(test);
	if(textTypeCount.length > 0){
		spaceTyping.innerHTML += textTypeCount.shift(); 
	}
	setTimeout("animateText()", 70); 
}

animateText();