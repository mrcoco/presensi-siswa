<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>{{ config.application.siteName }}</title>

<!-- Vendor stylesheet files. REQUIRED -->
<!-- BEGIN: Vendor  -->
<link rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/vendor.css">
<!-- END: core stylesheet files -->

<!-- Theme main stlesheet files. REQUIRED -->
<link rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/chl.css">
<link id="theme-list" rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/theme-peter-river.css">
<!-- END: theme main stylesheet files -->
<link rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/toastr.css">
<link rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/easy-autocomplete.min.css">
<!-- <link rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/easy-autocomplete.themes.min.css"> -->
{#<link rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/awesomplete.css">#}
{#<link rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/autocomplete.min.css" type="text/css"/>#}
<link rel="stylesheet" href="{{ url("themes/admin/") }}trumbowyg/dist/ui/trumbowyg.min.css" type="text/css"/>
<link rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/jquery.auto-complete.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">

{% if assets.exists("header") %}
    {{ assets.outputCss('header') }}
{% endif %}
<script type="text/javascript">
var public_url = "{{ config.application.publicUrl }}"
</script>
