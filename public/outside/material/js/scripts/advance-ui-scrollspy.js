$("nav").length?$(".toc-wrapper").pushpin({top:$("nav").height()}):$("#index-banner").length?$(".toc-wrapper").pushpin({top:$("#index-banner").height()}):$(".toc-wrapper").pushpin({top:0});
