<div class="body">
    <form>
    <input type="hidden" name="filter" value="1" value="{{request()->get('filter')}}"/>
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-6">
                <div class="form-group">
                    <label for="full_search" class="control-label">Busca</label>
                    <input type="text" class="form-control" name="full_search" id="full_search" value="{{request()->get('full_search')}}">
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <label>Periodo</label>
                <div class="input-daterange input-group" data-provide="datepicker">
                    <input type="text" class="input-sm form-control" name="start" value="{{request()->get('start')}}">
                    <span class="input-group-addon range-to">até</span>
                    <input type="text" class="input-sm form-control" name="end" value="{{request()->get('end')}}">
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6  mt-4">
                <button type="submit" class="btn btn-sm btn-primary btn-block" title="" style="margin-top: 3%;">
                    <i class="fa fa-search"></i>
                    Filtra
                </button>
            </div>
        </div>
    </form>
</div>
