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

## 🐍 Python w Projekcie

Projekt może wykorzystywać język Python do analizy danych, automatyzacji lub skryptów wspierających. W przypadku korzystania z Pythona:
- Zaleca się używanie wirtualnego środowiska (np. `venv` lub `conda`).
- Wymagane zależności powinny być dokumentowane w pliku `requirements.txt`.
- Foldery środowiska (np. `venv/`, `.env/`) oraz pliki tymczasowe są automatycznie ignorowane przez system kontroli wersji (`.gitignore`).

---

## 📝 Funkcjonalności
- Rozwiązywanie zadań (Zamknięte, Otwarte, Prawda-Fałsz).
- Podgląd statystyk ucznia.
- Panel nauczyciela do zarządzania listą uczniów i zadań.
- Losowe zadanie na stronie głównej dla zalogowanych użytkowników.

---
**Wykonanie:** Adamiak Filip
