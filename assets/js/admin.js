$(function() {
	let url 	= $('#data-admin').data('url');
    navbar_active();
    
    function navbar_active() {
        let linkNav     = $('#data-admin').data('link');
        $('.nav-link').removeClass('active');
        $.each($('.nav-link'),function(i,j) {
            let href    = j.attributes.href.value;
            let link    = url + linkNav;
			console.log(linkNav);
            if (href == link) {
                j.classList.add('active');  
                if (j.parentElement.parentElement.classList.contains('nav-treeview')) {
                    j.parentElement.parentElement.parentElement.classList.add('menu-open');
                    j.parentElement.parentElement.previousSibling.previousSibling.classList.add('active');
                }
            }

        })
    }
    
})
