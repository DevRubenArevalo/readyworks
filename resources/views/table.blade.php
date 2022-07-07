@include('_partials.head')
<div class="container">
    <div class="row">
        <div class="col-sm-12 p-2">
            <button id='ClearFilters' type="button" class="btn btn-primary">ClearFilters</button>
            <button id='ResetTable' type="button" class="btn btn-primary">Reset Computer Table</button>
            <div class="form-row col-md-4">
                <label class="col-sm-12 col-form-label" for="Departments">
                    Departments
                    <select id="Departments" class="form-control col-sm-10">
                        <option value=""> - </option>
                        @foreach($departments as $department)
                            <option value="{{$department}}">{{$department}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="form-row col-md-4">
                <label class="col-sm-12 col-form-label" for="ComputerTypes">
                    Computer Types
                    <input id="ComputerTypes" class="form-control col-sm-10"/>
                </label>
            </div>
            <div class="form-row col-md-4">
                <label class="col-sm-12 col-form-label" for="ComputerModels">
                    Computer Models
                    <select id="ComputerModels" class="form-control col-sm-10">
                        <option value=""> - </option>
                        @foreach($computerModels as $computerModel)
                        <option value="{{$computerModel}}">{{$computerModel}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <hr style="margin:1em">
        <div class="col-sm-12" style="padding-top:1em">
            <table id="DataTable"></table>
        </div>
    </div>
</div>
@include('_partials.js-includes')
<script>
    // Data table
    $(document).ready(async function () {
        await initDatatable();

        let datatable = $('#DataTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: 'api/v1/datatable-ssp',
        });

        $('#Departments').change(function () {
            alert('departments change');
            // todo: currently not working.
            datatable
                .columns(14)
                .search(this.value)
                .draw()
        });

        $('#ComputerModels').change(function () {
            alert('computer models change');
            // todo: currently not working.
            datatable
                .columns(5)
                .search(this.value)
                .draw()
        });

        $('#ComputerTypes').on('keyup', function () {
            alert('computer types change');
            // todo: currently not working.
            datatable
                .columns(6)
                .search(this.value)
                .draw()
        });

        $('#ClearFilters').click(async function () {
            $('#Departments').val('');
            $('#ComputerModels').val('');
            $('#ComputerTypes').val('');

            // todo: currently not working.
            datatable
                .search('')
                .columns()
                .search('')
                .draw();
        });

        $('#ResetTable').click(async function () {
            await axios.get('/api/v1/reset-database');
            alert('Database Reset. Refreshing page.');
            window.location.reload();
        });

    });
</script>
@include('_partials.footer')
