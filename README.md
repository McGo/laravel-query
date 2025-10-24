# laravel-request-query-filter
Filter eloquent queries based on request parameters



## TODO

- Rename to mcgo/laravel-query
- Query Class:

instanziert etnweder über Constructor oder static:

Query::model(ModelClass::class)
    ->forRequest(Request $request)
    ->withFilter(FilterClass::class)
    ->to(ResultClass::class)
    ->get();

oder

(new Query(ModelClass::class))
    ->forRequest($request)
    ->withFilter(FilterClass::class)
    ->to(ResultClass::class)
    ->get()


FilterClass Interface - ändert den QueryBuilder
RestulClass Interface - ändert die Ausgabe von get() -> offen für alles
    Standards werden mitgeliefert:
        toCollection() -> default ohne was zu definieren
        toJsonResourceCollection()
        
