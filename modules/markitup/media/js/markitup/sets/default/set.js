// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// BBCode tags example
// http://en.wikipedia.org/wiki/Bbcode
// ----------------------------------------------------------------------------
// Feel free to add more tags
// ----------------------------------------------------------------------------
mySettings = {
	markupSet: [
		{name:'Podtytuł', key:'T', className:'icon-font',  openWith:'#### ', placeHolder:'Tekst podtytułu...'},
		{separator:'|' },
		{name:'Pogrubienie', key:'B', className:'icon-bold', openWith:'**', closeWith:'**'},
		{name:'Pochylenie', key:'I', className:'icon-italic', openWith:'_', closeWith:'_'},
		{separator:'|' },
		{name:'Link', key:'L', className:'icon-bookmark', openWith:'[', closeWith:']([![Url:!:http://]!] "[![Tytuł]!]")', placeHolder:'Tekst linku...' },
		{name:'Obrazek', key:'P', className:'icon-picture', replaceWith:'![[![Tekst alternatywny]!]]([![Url:!:http://]!] "[![Tytuł]!]")'},
		{separator:'|' },
		{name:'Lista zwykła', className:'icon-list', openWith:'- ' },
		{name:'Lista numeryczna', className:'icon-list', openWith:function(markItUp) {
			return markItUp.line+'. ';
		}},
		{separator:'|'},	
		{name:'Cytat', className:'icon-comment', openWith:'> '},
		{name:'Kod', className:'icon-book', openWith:'(!(\t|!|`)!)', closeWith:'(!(`)!)'}
	]
}
miu = {
	markdownTitle: function(markItUp, char) {
		heading = '';
		n = $.trim(markItUp.selection||markItUp.placeHolder).length;
		for(i = 0; i < n; i++) {
			heading += char;
		}
		return '\n'+heading;
	}
}
