# Dokumentacja Projektu: Platforma Matematyczna

Projekt to interaktywna platforma do nauki matematyki, umożliwiająca nauczycielom przydzielanie zadań, a uczniom ich rozwiązywanie oraz śledzenie statystyk.

---

## 🛠 Technologie
- **Backend:** PHP 8.x + Laravel 8
- **Frontend:** Blade, Tailwind CSS 3, Alpine.js, Laravel Mix
- **Baza danych:** SQLite
- **Stylizacja:** Niestandardowe arkusze CSS (`site.css`, `card.css` itp.) zintegrowane z Tailwindem.

---

## 🚀 Jak uruchomić projekt
Jeśli masz już zainstalowane PHP, Composer i Node.js, wykonaj poniższe kroki w folderze `project/`:

1. **Instalacja zależności PHP:**
   ```bash
   composer install
   ```
2. **Instalacja zależności JS i kompilacja:**
   ```bash
   npm install
   npm run dev
   ```
3. **Konfiguracja środowiska:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Baza danych (SQLite):**
   ```bash
   touch database/database.sqlite
   php artisan migrate:fresh --seed
   ```
5. **Uruchomienie serwera:**
   ```bash
   php artisan serve
   ```
   Aplikacja będzie dostępna pod adresem: `http://127.0.0.1:8000`

---

## 🐍 Python w Projekcie (Projekt Zaliczeniowy)

Niniejsza platforma matematyczna stanowi część **projektu zaliczeniowego z przedmiotu związanego z programowaniem w języku Python**. Język ten odgrywa kluczową rolę jako zaplecze analityczne i wspierające, rozszerzając możliwości głównej aplikacji napisanej w PHP.

**Główne obszary wykorzystania Pythona w projekcie:**
- **Analiza Danych i Statystyki:** Przetwarzanie i agregacja wyników uczniów, generowanie zaawansowanych statystyk (np. z wykorzystaniem bibliotek takich jak `pandas` czy `matplotlib`), co wspiera panel nauczyciela.
- **Zautomatyzowane Skrypty Wspierające:** Usprawnienie procesów deweloperskich, automatyzacja ewaluacji rozwiązań oraz zarządzania bazą danych (w tym wsadowe wczytywanie zadań).
- **Przetwarzanie w tle:** Wykonywanie zadań o wysokiej złożoności obliczeniowej bez obciążania głównego serwera HTTP w Laravelu.

**Instrukcje uruchomienia i konfiguracji środowiska Python:**
- Uruchomienie skryptów wspierających powinno zawsze odbywać się w odizolowanym wirtualnym środowisku (zalecane: `venv` lub `conda`).
- Pełna lista zależności znajduje się w pliku `requirements.txt`. Zainstaluj je używając komendy: `pip install -r requirements.txt`.
- W trosce o porządek i integralność kodu, foldery środowiska (np. `venv/`, `.env/`) oraz wrażliwe pliki konfiguracyjne i testowe są automatycznie ignorowane przez system kontroli wersji (`.gitignore`).

---

## 📝 Funkcjonalności
- Rozwiązywanie zadań (Zamknięte, Otwarte, Prawda-Fałsz).
- Podgląd statystyk ucznia.
- Panel nauczyciela do zarządzania listą uczniów i zadań.
- Losowe zadanie na stronie głównej dla zalogowanych użytkowników.

---
**Wykonanie:** Adamiak Filip

---

## 📖 Szczegółowa specyfikacja widoków

### Welcome:
- widok startowy z opisem strony, jej funkcjonalnością i przyciskami zaloguj/zarejestruj

### Rejestracja:
- widok początkowy z wyborem uczeń/nauczyciel, informacją co robią dane uprawnienia, oraz przyciskiem dalej który w zależności od roli wyświetla rejestrację ucznia/nauczyciela
- **rejestracja ucznia:** imie, nazwisko, id_nauczyciela, mail, haslo, potwierdzenie hasla, przycisk zarejestruj
- **rejestracja nauczyciela:** imie, nazwisko, mail, haslo, potwierdzenie hasla, przycisk zarejestruj

### Logowanie:
- formularz z polami email, haslo i przycisk zaloguj (bądź wysuwane logowanie na stronie welcome – zrobione w javascripcie)

### Strona główna:
#### Uczeń:
- krótki opis strony oraz jej celu, 
- ?losowe zadanie do rozwiązania (tylko abcd, prawdopodobnie jedno na logowanie – podczas jednej sesji tylko jedno zadanie do rozwiązania - po zatwierdzeniu zaznaczenie poprawnej odpowiedzi na zielono (i błędnej na czerwono) i zmienienie borderu na zielony/czerwony w zależności od poprawności zadania)? 
- menu w gornym pasku: statystyki, moje zadania, oraz logo/”witaj imie nazwisko”, wyloguj
- szybkie podsumowanie

#### Nauczyciel:
- krótki opis strony oraz jej celu,
- lista uczniów podpiętych do nauczyciela (albo kilku uczniów z możliwością przejścia do strony wyświetlającej pełną listę uczniów – przy każdym uczniu możliwość podglądnięcia widoku strony ucznia z poziomu nauczyciela (!inny niż to co widzi uczeń!) z zadaniami do zrobienia/rozwiązanych, przyciskiem „usuń zadanie” i statystykami);
- menu w górnym pasku: statystyki, zadania, logo/”witaj imie nazwisko”, id_nauczyciela, wyloguj,
- szybkie podsumowanie 

### Moje zadania:
#### Uczeń:
- wyświetlenie kilku pierwszych zadań do zrobienia z opcją pokaż wszystkie -> za pomocą javascriptu rozwiązanie zadania i przeslanie odpowiedzi,
- wyświetlenie kilku pierwszych zadań zrobionych ocenionych z opcją pokaż wszystkie -> za pomocą javascriptu wyświetlenie rozwiązanego zadania z przesłaną odpowiedzią i poprawną odpowiedzią, (tytuł, polecenie, podana odpowiedź, termin oddania, data oddania, poprawna odpowiedź)
- po kliknięciu „pokaż wszystkie” przeniesienie do strony z listą zadań (index.blade.php) 

#### Nauczyciel:
- wyświetl zadania -> lista wszystkich zadań dodanych przez danego nauczyciela z możliwością wyświetlenia, edycji i usunięcia zadania
- przycisk przypisz zadanie -> formularz:
- wyświetlenie listy uczniów w postaci checkboxow, 
- wybor tytulu zadania 
- termin oddania 
- utwórz zadanie  -> formularz:
	- pierwszy widok z wyborem rodzaju zadania:
	- w zależności od wyboru przejście na stronę z odpowiednim formularzem (tytuł zadania, treść zadania, ?poprawna odpowiedź?, w abcd: błędne odpowiedzi, zatwierdź)
- przeglądnij oddane zadania  (wyświetl trzy z możliwością przejścia do listy)

### Statystyki: (osobno lub na stronie głównej w zależności od ilości wykresów)
- szybkie podsumowanie raz jeszcze na górze strony, 
- wykresy różne itd. 
