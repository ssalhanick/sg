/*! Stomping Ground v2.01 | (c) 2020 S |  License | https://github.com/ssalhanick/sg */
document.addEventListener('click', (function (event) {
	if (!event.target.matches('#click-me')) return;
	alert('You clicked me!');
}), false);
