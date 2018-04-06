@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Редактирование вакансии</h3>
                <div class="card">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form method="post" action="{{ route('vacancies.update', $vacancy->id) }}">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="form-group">
                                    <input type="hidden" name="id">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle">Название вакансии</label>
                                    <input type="text" class="form-control" id="inputTitle" name="title"
                                           placeholder="Название вакансии" value="{{ $vacancy->title  }}">
                                </div>
                                @if ($errors->first('title'))
                                    <div class="alert alert-danger">{{  $errors->first('title') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputCompany">Название компании</label>
                                    <input type="text" class="form-control" id="inputCompany" name="company"
                                           placeholder="Название компании" value="{{ $vacancy->company  }}">
                                </div>
                                @if ($errors->first('company'))
                                    <div class="alert alert-danger">{{  $errors->first('company') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputCity">Ваш город</label>
                                    <input type="text" class="form-control" id="inputCity" name="city"
                                           placeholder="Город" value="{{ $vacancy->city  }}">
                                </div>
                                @if ($errors->first('city'))
                                    <div class="alert alert-danger">{{  $errors->first('city') }}</div>
                                @endif
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Категория</label>
                                    <select class="custom-select my-1 mr-sm-2" name="category_id"
                                            id="inlineFormCustomSelectPref">
                                        <option selected>Выберите категорию...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->first('category_id'))
                                    <div class="alert alert-danger">{{  $errors->first('category_id') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputRequirements">Требования к соискателю</label>
                                    <input type="text" class="form-control" id="inputRequirements" name="requirements"
                                           placeholder="Перечень требований" value="{{ $vacancy->requirements  }}">
                                </div>
                                @if ($errors->first('requirements'))
                                    <div class="alert alert-danger">{{  $errors->first('requirements') }}</div>
                                @endif
                                @foreach($vacancy->employment_type as $value )
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="employment_type[]"
                                                   id="{{ $value }}" value="{{ $value }}" checked>
                                            <label class="form-check-label" for="{{ $value }}">{{ $value }}</label>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    @if (!in_array("полная занятость", $vacancy->employment_type) )
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="employment_type[]"
                                                   id="exampleCheck1" value="полная занятость">
                                            <label class="form-check-label" for="exampleCheck1">полная занятость</label>
                                        </div>
                                    @endif
                                    @if (!in_array("неполная занятость", $vacancy->employment_type) )
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="employment_type[]"
                                                   id="exampleCheck2" value="неполная занятость">
                                            <label class="form-check-label" for="exampleCheck2">неполная
                                                занятость</label>
                                        </div>
                                    @endif
                                    @if (!in_array("удалённая работа", $vacancy->employment_type))
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="employment_type[]"
                                                   id="exampleCheck3" value="удалённая работа">
                                            <label class="form-check-label" for="exampleCheck3">удалённая работа</label>
                                        </div>
                                    @endif
                                </div>
                                @if ($errors->first('employment_type'))
                                    <div class="alert alert-danger">{{  $errors->first('employment_type') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputSalary">Зарплата</label>
                                    <input type="text" class="form-control" id="inputSalary" name="salary"
                                           placeholder="Зарплата" value="{{ $vacancy->salary }}">
                                </div>
                                @if ($errors->first('salary'))
                                    <div class="alert alert-danger">{{  $errors->first('salary') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputContactName">Контактное лицо</label>
                                    <input type="text" class="form-control" id="inputContactName" name="contact_name"
                                           placeholder="Контактное лицо (Ф.И.)" value="{{ $vacancy->contact_name  }}">
                                </div>
                                @if ($errors->first('contact_name'))
                                    <div class="alert alert-danger">{{  $errors->first('contact_name') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputPhone">Телефон</label>
                                    <input type="text" class="form-control" id="inputPhone" name="phone"
                                           placeholder="Телефон" value="{{ $vacancy->phone  }}">
                                </div>
                                @if ($errors->first('phone'))
                                    <div class="alert alert-danger">{{  $errors->first('phone') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Описание вакансии</label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                              rows="3">{{  $vacancy->description }}</textarea>
                                </div>
                                @if ($errors->first('description'))
                                    <div class="alert alert-danger">{{  $errors->first('description') }}</div>
                                @endif
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
