<script src="{{ url("themes/frontend/") }}js/jquery.js"></script>
<script src="{{ url("themes/frontend/") }}js/bootstrap.min.js"></script>
<script src="{{ url("themes/frontend/") }}js/owl.carousel.min.js"></script>
<script src="{{ url("themes/frontend/") }}js/mousescroll.js"></script>
<script src="{{ url("themes/frontend/") }}js/smoothscroll.js"></script>
<script src="{{ url("themes/frontend/") }}js/jquery.prettyPhoto.js"></script>
<script src="{{ url("themes/frontend/") }}js/jquery.isotope.min.js"></script>
<script src="{{ url("themes/frontend/") }}js/jquery.inview.min.js"></script>
<script src="{{ url("themes/frontend/") }}js/wow.min.js"></script>
<script src="{{ url("themes/frontend/") }}js/main.js"></script>

{% if assets.exists("footer") %}
    {{ assets.outputJs('footer') }}
{% endif %}
