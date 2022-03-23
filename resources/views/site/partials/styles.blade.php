<!-- external links -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/solid.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/light.min.css" />

<!-- Custom styles -->
<link rel="stylesheet" href="{{ asset('css/category.css') }}">

<style>
    .navbar .megamenu {
        padding: 1rem;
    }

    /* ============ desktop view ============ */
    @media all and (min-width: 992px) {

        .navbar .has-megamenu {
            position: static !important;
        }

        .navbar .megamenu {
            left: 0;
            right: 0;
            width: 100%;
            margin-top: 0;
        }

    }

    /* ============ desktop view .end// ============ */


    /* ============ mobile view ============ */
    @media(max-width: 991px) {

        .navbar.fixed-top .navbar-collapse,
        .navbar.sticky-top .navbar-collapse {
            overflow-y: auto;
            max-height: 90vh;
            margin-top: 10px;
        }
    }
</style>
