# PHP Project
## Welcome:
- widok startowy z opisem strony, jej funkcjonalnością i przyciskami zaloguj/zarejestruj

### Rejestracja:
- widok początkowy z wyborem uczeń/nauczyciel, informacją co robią dane uprawnienia, oraz przyciskiem dalej który w zależności od roli wyświetla rejestrację ucznia/nauczyciela^ rejestracja ucznia: imie, nazwisko, id_nauczyciela, mail, haslo, potwierdzenie hasla, przycisk zarejestruj
	^ rejestracja nauczyciela: imie, nazwisko, mail, haslo, potwierdzenie hasla, przycisk zarejestruj

### Logowanie:
 - formularz z polami email, haslo i przycisk zaloguj (bądź wysuwane logowanie na stronie welcome – zrobione w javascripcie)

## Strona główna:
### Uczeń:
- krótki opis strony oraz jej celu, 
- ?losowe zadanie do rozwiązania (tylko abcd, prawdopodobnie jedno na logowanie – podczas jednej sesji tylko jedno zadanie do rozwiązania - po zatwierdzeniu zaznaczenie poprawnej odpowiedzi na zielono (i błędnej na czerwono) i zmienienie borderu na zielony/czerwony w zależności od poprawności zadania)? 
- menu w gornym pasku: statystyki, moje zadania, oraz logo/”witaj imie nazwisko”, wyloguj
- szybkie podsumowanie
### Nauczyciel:
- krótki opis strony oraz jej celu,
- lista uczniów podpiętych do nauczyciela (albo kilku uczniów z możliwością przejścia do strony wyświetlającej pełną listę uczniów – przy każdym uczniu możliwość podglądnięcia widoku strony ucznia z poziomu nauczyciela (!inny niż to co widzi uczeń!) z zadaniami do zrobienia/rozwiązanych, przyciskiem „usuń zadanie” i statystykami);
- menu w górnym pasku: statystyki, zadania, logo/”witaj imie nazwisko”, id_nauczyciela, wyloguj,
- szybkie podsumowanie 

## Moje zadania:
### Uczeń:
- wyświetlenie kilku pierwszych zadań do zrobienia z opcją pokaż wszystkie -> za pomocą javascriptu rozwiązanie zadania i przeslanie odpowiedzi,
- wyświetlenie kilku pierwszych zadań zrobionych ocenionych z opcją pokaż wszystkie -> -> za pomocą javascriptu wyświetlenie rozwiązanego zadania z przesłaną odpowiedzią i poprawną odpowiedzią, (tytuł, polecenie, podana odpowiedź, termin oddania, data oddania, poprawna odpowiedź)
- po kliknięciu „pokaż wszystkie” przeniesienie do strony z listą zadań (index.blade.php) 
### Nauczyciel:
- wyświetl zadania -> lista wszystkich zadań dodanych przez danego nauczyciela z możliwością wyświetlenia, edycji i usunięcia zadania
- przycisk przypisz zadanie -> formularz:
- wyświetlenie listy uczniów w postaci checkboxow, 
- wybor tytulu zadania 
- termin oddania 
- utwórz zadanie  -> formularz:
	- pierwszy widok z wyborem rodzaju zadania:
	- w zależności od wyboru przejście na stronę z odpowiednim formularzem (tytuł zadania, treść zadania, ?poprawna odpowiedź?, w abcd: błędne odpowiedzi, zatwierdź)
- przeglądnij oddane zadania  (wyświetl trzy z możliwością przejścia do listy)

## Statystyki: (osobno lub na stronie głównej w zależności od ilości wykresów)
- szybkie podsumowanie raz jeszcze na górze strony, 
- wykresy różne itd. 

