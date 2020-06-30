@foreach($documents as $document)
    <div class="col-md-2">
            <div class="icon bg-dark hvr-float-shadow" style="display: flex;justify-content: center;align-items: center;border-radius: 5px; margin:5px;">
                <a href="{{asset('storage/'.$document->name)}}" target="blank" style="color: #fff;font-weight: bold;text-transform: uppercase;">
                    @if(in_array($document->extension_document,['jpg','png','jpeg']))
                        <img src="{{asset('img/files/jpg.svg')}}" style="width: 43px;padding: 5px;"/>
                    @elseif(in_array($document->extension_document,['doc','docx']))
                        <img src="{{asset('img/files/doc.svg')}}" style="width: 43px;padding: 5px;"/>
                    @elseif($document->extension_document == 'pdf')
                        <img src="{{asset('img/files/pdf.svg')}}" style="width: 43px;padding: 5px;"/>
                    @elseif(in_array($document->extension_document,['xls','xlsx','csv']))
                        <img src="{{asset('img/files/tablet.svg')}}" style="width: 43px;padding: 5px;"/>
                    @endif
                    Baixar
                </a>
            </div>
    </div>
@endforeach
