@extends('biblioteca.layout')


@section('content')
    <div class="row no-gutters p-md-5 p-2">

        <div class="col-md-4 col-12 px-2">
            <div class="text-center"><i><span class="fa fa-user fa-5x"></span></i></div>
            <p class="mt-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci architecto
                consequatur cum eum laborum magni nam necessitatibus nisi? Ad cumque debitis
                dolore eum hic laboriosam nesciunt odit officia omnis similique.

            </p>
        </div>
        <div class="col-md-4 col-12 px-2">
            <div class="text-center"><i><span class="fa fa-industry fa-5x"></span></i></div>
            <p class="mt-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci architecto
                consequatur cum eum laborum magni nam necessitatibus nisi? Ad cumque debitis
                dolore eum hic laboriosam nesciunt odit officia omnis similique.
            </p>
        </div>
        <div class="col-md-4 col-12 px-2">
            <div class="text-center"><i><span class="fa fa-dashboard fa-5x"></span></i></div>
            <p class="mt-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci architecto
                consequatur cum eum laborum magni nam necessitatibus nisi? Ad cumque debitis
                dolore eum hic laboriosam nesciunt odit officia omnis similique.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-5 p-5">
            <address class="m-lg-5">
                <b class="d-block">Twitter, Inc.</b>
                <p>1355 Market St, Suite 900</p>
                <p>San Francisco, CA 94103</p>
                <p> <abbr title="Phone Number">P</abbr>: (123) 456-7890 </p>
            </address>
        </div>
        <div class="col-12 col-md-7">
            <form>
                <div class="md-form">
                    <label for="name">Name</label>
                    <input type="text" name="" class="form-control" id="name">
                </div>
                <div class="md-form">
                    <label for="email">Email</label>
                    <input type="email" name="" class="form-control" id="email">
                </div>
                <div class="md-form">
                    <label for="pswd">Password</label>
                    <input type="password" name="" class="form-control" id="pswd">
                </div>
                <div class="md-form">
                    <input type="password" name="" class="form-control" id="r-paswd">
                    <label for=r-paswd>Repeat Password</label>
                </div>
                <div class="text-center text-lg-right">
                    <input type="submit"   name="submit" id="submit" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>

 @endsection