<div class="body">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="phone" class="control-label">Número Chamado</label>
                <input type="text" class="form-control" name="ticket_number">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="phone" class="control-label">Projetos</label>
                <select name="project_id" id="project_id" class="form-control selectize">
                    <option>Selecione</option>
                    @forelse ($projects as $project)
                        <option value="{{$project->id}}">{{$project->name}}</option>
                    @empty
                        <option>Nenhum Projeto encontrado</option>>
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="phone" class="control-label">Prioridade</label>
                <select name="priority_id" id="priority_id" class="form-control selectize">
                    <option>Selecione</option>
                    @forelse ($priorities as $priority)
                        <option value="{{$priority->id}}">{{$priority->name}}</option>
                    @empty
                        <option>Nenhum Projeto encontrado</option>>
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="phone" class="control-label">Tipo Chamado</label>
                <select name="type_id" class="form-control selectize">
                    <option>Selecione</option>
                    @forelse ($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @empty
                        <option>Nenhum Tipo encontrado</option>>
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="status" class="control-label">Status</label>
                <select name="status" class="form-control selectize">
                    <option>Selecione</option>
                    <option value="E">Em Espera</option>
                    <option value="T">Em Tratamento</option>
                    <option value="P">Pausado</option>
                    <option value="AC">Aguardando Cliente</option>
                    <option value="AE">Aguardando Evidencia</option>
                    <option value="AT">Aguardando T.I</option>
                    <option value="ATRA">Atrasado</option>
                    <option value="C">Concluído</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="phone" class="control-label">Impacto</label>
                <select name="impact_id" class="form-control selectize">
                    <option>Selecione</option>
                    @forelse ($impacts as $impact)
                        <option value="{{$impact->id}}">{{$impact->name}}</option>
                    @empty
                        <option>Nenhum Impacto encontrado</option>>
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <label>Periodo</label>
            <div class="input-daterange input-group" data-provide="datepicker">
                <input type="text" class="input-sm form-control" name="start">
                <span class="input-group-addon range-to">até</span>
                <input type="text" class="input-sm form-control" name="end">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6  mt-4">
            <button href="javascript:void(0);" class="btn btn-sm btn-primary btn-block" title="">
                <i class="fa fa-search"></i>
                Filtra
            </button>
        </div>
    </div>
</div>
