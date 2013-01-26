window.onload = function() {
var editor = new Behave({

	textarea: document.getElementById('editor'),
	replaceTab: true,
	softTabs: true,
	softTabSize: 4,
	autoOpen: true,
	overwrite: true,
	autoStrip: true,
	autoIndent: true

});
};