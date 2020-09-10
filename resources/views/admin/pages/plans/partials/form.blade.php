<div class="card">
    <div class="card-body">

        <div class="card">
            <div class="card-body">
                <div class="form-grup">
                    <label for="">Nome:</label>
                    <input type="text" class="form-control" name="name" placeholder="Nome:" value="{{$plan->name ?? old('name')}}">
                </div>
                <div class="form-group">
                    <label for="">Preço:</label>
                    <input type="text" class=" form-control" name="price" placeholder="Preço:" value="{{$plan->price ?? old('price')}}">
                </div>
                <div class="form-group">
                    <label for="">Descrição</label>
                    <input type="text" class=" form-control" name="description" placeholder="Descrição:" value="{{$plan->description ?? old('description')}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-dark">Enviar</button>
                </div>

            </div>
        </div>
    </div>
</div>
