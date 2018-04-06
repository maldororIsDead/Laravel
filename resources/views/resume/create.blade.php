@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Создать резюме</h3>
                <div class="card">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form method="post" action="{{ route('resume.store') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name="id">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Ваше имя</label>
                                    <input type="text" class="form-control" id="inputName" name="name"
                                           placeholder="Введите ваше имя" value="{{ Auth::user()->name }}">
                                </div>
                                @if ($errors->first('name'))
                                    <div class="alert alert-danger">{{  $errors->first('name') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputSurname">Ваша фамилия</label>
                                    <input type="text" class="form-control" id="inputSurname" name="surname"
                                           placeholder="Введите вашу фамилию" value="{{ Auth::user()->surname }}">
                                </div>
                                @if ($errors->first('surname'))
                                    <div class="alert alert-danger">{{  $errors->first('surname') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputPatronymic">Ваше отчество</label>
                                    <input type="text" class="form-control" id="inputPatronymic" name="patronymic"
                                           placeholder="Введите ваше отчество" value="{{ Auth::user()->patronymic }}">
                                </div>
                                @if ($errors->first('patronymic'))
                                    <div class="alert alert-danger">{{  $errors->first('patronymic') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputAge">Ваш возраст</label>
                                    <input type="text" class="form-control" id="inputAge" name="age"
                                           placeholder="Введите ваш возраст">
                                </div>
                                @if ($errors->first('age'))
                                    <div class="alert alert-danger">{{  $errors->first('patronymic') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputEmail">Электронная почта</label>
                                    <input type="email" class="form-control" id="inputEmail" name="email"
                                           placeholder="Электронная почта" value="{{ Auth::user()->email }}">
                                </div>
                                @if ($errors->first('email'))
                                    <div class="alert alert-danger">{{  $errors->first('email') }}</div>
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
                                    <label for="inputPost1">Должность на которой вы хотите работать</label>
                                    <input type="text" class="form-control" id="inputPost1" name="post"
                                           placeholder="Введите вашу должность">
                                </div>
                                @if ($errors->first('post'))
                                    <div class="alert alert-danger">{{  $errors->first('post') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputCity">Желаемый город работы</label>
                                    <input type="text" class="form-control" id="inputCity" name="city"
                                           placeholder="Город">
                                </div>
                                @if ($errors->first('city'))
                                    <div class="alert alert-danger">{{  $errors->first('city') }}</div>
                                @endif
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="employment_type[]"
                                               id="exampleCheck1" value="полная занятость">
                                        <label class="form-check-label" for="exampleCheck1">полная занятость</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="employment_type[]"
                                               id="exampleCheck2" value="неполная занятость">
                                        <label class="form-check-label" for="exampleCheck2">неполная занятость</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="employment_type[]"
                                               id="exampleCheck3" value="удалённая работа">
                                        <label class="form-check-label" for="exampleCheck3">удалённая работа</label>
                                    </div>
                                </div>
                                @if ($errors->first('employment_type'))
                                    <div class="alert alert-danger">{{  $errors->first('employment_type') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputPhone">Телефон</label>
                                    <input type="text" class="form-control" id="inputPhone" name="phone"
                                           placeholder="Телефон">
                                </div>
                                @if ($errors->first('salary'))
                                    <div class="alert alert-danger">{{  $errors->first('salary') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputSalary">Зарплата</label>
                                    <input type="text" class="form-control" id="inputSalary" name="salary"
                                           placeholder="Зарплата">
                                </div>
                                @if ($errors->first('salary'))
                                    <div class="alert alert-danger">{{  $errors->first('salary') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputEducation">Образование</label>
                                    <input type="text" class="form-control" id="inputEducation" name="education"
                                           placeholder="Образование">
                                </div>
                                @if ($errors->first('education'))
                                    <div class="alert alert-danger">{{  $errors->first('education') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Дополнительная информация</label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                              rows="3"></textarea>
                                </div>
                                @if ($errors->first('description'))
                                    <div class="alert alert-danger">{{  $errors->first('description') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="inputFile">Загрузить файл</label>
                                    <input type="file" id="inputFile" name="file"/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
