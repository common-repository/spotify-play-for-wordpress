function spbfwplugin() {
	var track = prompt("Spotify Track URI", "");
	inpost = '[spotify track="' + track + '"]';
    return inpost;
}

(function() {

    tinymce.create('tinymce.plugins.spbfwplugin', {

        init : function(ed, url){
            ed.addButton('spbfwplugin', {
                title : 'Insert Spotify Track',
                onclick : function() {
                    ed.execCommand(
                        'mceInsertContent',
                        false,
                        spbfwplugin()
                        );
                },
                image: url + "/spotify.png"
            });
        },

        getInfo : function() {
            return {
                longname : 'Contnet Mage plugin',
                author : 'Grzegorz Winiarski',
                authorurl : 'http://ditio.net',
                infourl : '',
                version : "1.0"
            };
        }
    });

    tinymce.PluginManager.add('spbfwplugin', tinymce.plugins.spbfwplugin);
    
})();
