@include('includes.header')

    <section class="intro">
        <div class="bg-image h-100">
            <div class="mask d-flex align-items-center h-100" style="background-color: #f3f2f2;">
                <div class="container d-flex align-items-center justify-content-center ">
                            <div class="card" style="border-radius: 1rem; max-width:700px">
                                        <div class="card-body py-5 px-4 p-md-5">

                                            <form action="{{ route('store-trip') }}" method="POST">
                                                @csrf <!-- CSRF token for security -->
                                                @if (Session::has('fail'))
                                                    <div class="alert alert-danger">
                                                        {{ Session::get('fail') }}
                                                    </div>
                                                @endif
                                                <h4 class="fw-bold mb-4" style="color:black;">Proposer un Trajet
                                                </h4>
                                                <p class="mb-4">To login, please fill in these text fields with your
                                                    e-mail address and
                                                    password.</p>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="depart">Lieu de départ</label>
                                                    <input type="text" id="depart" name="depart"
                                                        class="form-control" />
                                                    <!--  validation/error messages -->
                                                    @error('depart')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="destination">Destination</label>
                                                    <input type="text" id="destination" name="destination"
                                                        class="form-control" />
                                                    <!--  validation/error messages  -->
                                                    @error('destination')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="heure_depart">Heure de depart</label>
                                                    <input type="datetime-local" id="heure_depart" name="heure_depart"
                                                        class="form-control" />
                                                    <!--  validation/error messages  -->
                                                    @error('heure_depart')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label"
                                                        for="places_disponibles">Nombre de places disponibles</label>
                                                    <input type="number" id="places_disponibles"
                                                        name="places_disponibles" class="form-control" />
                                                    <!--  validation/error messages  -->
                                                    @error('places_disponibles')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="prix">Prix</label>
                                                    <input type="number" id="prix" name="prix"
                                                        class="form-control" />
                                                    <!--  validation/error messages  -->
                                                    @error('prix')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex justify-content-end pt-1 mb-4">
                                                    <button class="btn btn-primary btn-rounded" type="submit"
                                                        style="background-color: #6610F2;">Creer</button>
                                                </div>
                                                <hr>
                                            </form>

                                        </div>
                            </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
