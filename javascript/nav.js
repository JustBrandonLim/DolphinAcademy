$(document).ready(function()
{
    toggleActiveNavBar();
});

function toggleActiveNavBar()
{
    var current_page_URL = location.href;
    $(".navbar-nav a").each(function()
    {
        var target_URL = $(this).prop("href");
        if (target_URL === current_page_URL)
        {
            $('nav a').removeClass('active');
            $(this).addClass('active');
            return false;
        }
    });
}