(function($,w,d){
	"use strict";
	$(d).ready(function(){
		responsiveDataTables();
		$(w).load(function(){
			responsiveDataTables();
		}).resize(function(){
			responsiveDataTables();
		});
	});
	var responsiveDataTables = function(){
		$('table.data-table').each(function(i,me){
			if($(me).width() > $(me).parent().first().width()){
				// table is bigger than container, set the responsive width (give an extra 50px buffer)
				$(me).attr('data-respond-at',($(me).width()+50));
			}
			$(me).toggleClass('respond',($(me).width() < $(me).attr('data-respond-at')?true:false) );
		});
	};
}(jQuery,window,document));