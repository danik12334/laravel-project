<?php

namespace App\Http\Controllers;

use App\Models\NewBook;
use App\Models\BestBook;
use App\Models\AwardBook;
use App\Models\ExclusiveBook;
use App\Models\ComingSoonBook;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    // === Главная страница ===
    public function home()
    {
        return view('home');
    }

    // === О компании ===
    public function about()
    {
        return view('about');
    }

    // === Контакты ===
    public function contacts()
    {
        return view('contacts');
    }

    // === Каталог книг ===
    public function catalog()
    {
        return view('catalog', [
            'newBooks' => NewBook::orderBy('id')->limit(6)->get(),
            'bestBooks' => BestBook::orderBy('id')->limit(6)->get(),
            'awardBooks' => AwardBook::orderBy('id')->limit(6)->get(),
            'exclusiveBooks' => ExclusiveBook::orderBy('id')->limit(6)->get(),
            'comingSoonBooks' => ComingSoonBook::orderBy('id')->limit(6)->get()
        ]);
    }

    // === Отображение категории книг ===
    public function showCategory($category)
    {
        $model = match ($category) {
            'new' => NewBook::class,
            'best' => BestBook::class,
            'award' => AwardBook::class,
            'exclusive' => ExclusiveBook::class,
            'coming' => ComingSoonBook::class,
            default => abort(404),
        };

        $title = match ($category) {
            'new' => 'Новинки литературы',
            'best' => 'Лучшие из лучших',
            'award' => 'Финалисты премии «Большая книга»',
            'exclusive' => 'Эксклюзивно в «BookShop»',
            'coming' => 'Скоро в продаже',
            default => 'Каталог'
        };

    // Выводим записи, упорядоченные по id
        $books = $model::orderBy('id')->paginate(18);

        return view('catalog.all', [
            'books' => $books,
            'title' => $title,
            'category' => $category,
            'bookType' => $category
        ]);
    }

    // === Метод showAll() для отображения всех книг категории с пагинацией ===
    public function showAll($category)
    {
        $config = match ($category) {
            'new' => [
                'model' => NewBook::class,
                'title' => 'Новинки литературы',
                'bookType' => 'new'
            ],
            'best' => [
                'model' => BestBook::class,
                'title' => 'Лучшие книги',
                'bookType' => 'best'
            ],
            'award' => [
                'model' => AwardBook::class,
                'title' => 'Финалисты премии «Большая книга»',
                'bookType' => 'award'
            ],
            'exclusive' => [
                'model' => ExclusiveBook::class,
                'title' => 'Эксклюзивно в BookShop',
                'bookType' => 'exclusive'
            ],
            'coming' => [
                'model' => ComingSoonBook::class,
                'title' => 'Скоро в продаже',
                'bookType' => 'coming'
            ],
            default => abort(404),
        };

        $books = $config['model']::orderBy('id')->paginate(18);

        return view('catalog.all', [
            'books' => $books,
            'title' => $config['title'],
            'category' => $category,
            'bookType' => $config['bookType']
        ]);
    }

    // === Создание новой книги ===
    public function create()
    {
        $type = request()->query('type');
        $title = match ($type) {
            'new' => 'Добавить новинку',
            'best' => 'Добавить в лучшие',
            'award' => 'Добавить премиальную',
            'exclusive' => 'Добавить эксклюзив',
            'coming' => 'Добавить будущую',
            default => 'Добавить книгу'
        };
        return view('books.create', compact('title', 'type'));
    }

    // === Сохранение новой книги ===
    public function store(Request $request)
    {
        $type = $request->input('type');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'publisher' => 'required|string|max:255',
            'series' => 'nullable|string|max:255',
            'year' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'price' => 'required|numeric',
            'image' => 'required|string',
        ]);

        $model = match ($type) {
            'new' => NewBook::class,
            'best' => BestBook::class,
            'award' => AwardBook::class,
            'exclusive' => ExclusiveBook::class,
            'coming' => ComingSoonBook::class,
            default => abort(404),
        };

        $model::create($validated);

        return redirect()->route('catalog.category', ['category' => $type])
            ->with('success', 'Книга успешно добавлена!');
    }

    // === Обновление книги ===
    public function update(Request $request, $id)
    {
        $type = $request->input('type');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'publisher' => 'required|string|max:255',
            'series' => 'nullable|string|max:255',
            'year' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'price' => 'required|numeric',
            'image' => 'required|string',
        ]);

        $model = match ($type) {
            'new' => NewBook::class,
            'best' => BestBook::class,
            'award' => AwardBook::class,
            'exclusive' => ExclusiveBook::class,
            'coming' => ComingSoonBook::class,
            default => abort(404),
        };

        $book = $model::findOrFail($id);
        $book->update($validated);

        return redirect()->route('catalog.category', ['category' => $type])
            ->with('success', 'Книга успешно обновлена!');
    }

    // === Просмотр одной книги ===
    public function show($id)
    {
        $type = request()->query('type');
        $model = match ($type) {
            'new' => NewBook::class,
            'best' => BestBook::class,
            'award' => AwardBook::class,
            'exclusive' => ExclusiveBook::class,
            'coming' => ComingSoonBook::class,
            default => abort(404),
        };
        $book = $model::findOrFail($id);
        return view('books.show', compact('book', 'type'));
    }

    // === Редактирование книги ===
    public function edit($id)
    {
        $type = request()->query('type');
        $model = match ($type) {
            'new' => NewBook::class,
            'best' => BestBook::class,
            'award' => AwardBook::class,
            'exclusive' => ExclusiveBook::class,
            'coming' => ComingSoonBook::class,
            default => abort(404),
        };
        $book = $model::findOrFail($id);
        return view('books.edit', compact('book', 'type'));
    }

    // === Удаление книги ===
    public function destroy($id)
    {
        $type = request()->input('type');
        $model = match ($type) {
            'new' => NewBook::class,
            'best' => BestBook::class,
            'award' => AwardBook::class,
            'exclusive' => ExclusiveBook::class,
            'coming' => ComingSoonBook::class,
            default => abort(404),
        };
        $book = $model::findOrFail($id);
        $book->delete();
        return back()->with('success', 'Книга удалена');
    }

    // === Добавление в корзину ===
    public function addToCart(Request $request, $type, $id)
    {
        $model = match ($type) {
            'new' => NewBook::class,
            'best' => BestBook::class,
            'award' => AwardBook::class,
            'exclusive' => ExclusiveBook::class,
            'coming' => ComingSoonBook::class,
            default => abort(404),
        };

        $book = $model::findOrFail($id);

        $cart = Session::get('cart', []);
        $key = "{$type}-{$id}";

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $cart[$key] = [
                'type' => $type,
                'id' => $id,
                'title' => $book->title,
                'price' => $book->price,
                'image' => $book->image,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        return back()->with('success', 'Книга добавлена в корзину');
    }

    // === Удаление из корзины ===
    public function removeFromCart($type, $id)
    {      
        $cart = session()->get('cart', []);
        $key = "{$type}-{$id}";

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            return back()->with('success', 'Книга удалена из корзины');
        }

        return back()->with('error', 'Книга не найдена в корзине');
    }

    // === Страница корзины ===
    public function cart()
    {
        $cartItems = session()->get('cart', []);

        return view('cart', compact('cartItems'));
    }

    // === Оформление заказа ===
    public function checkout(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
        ]);

        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return back()->with('error', 'Ваша корзина пуста');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));

        Order::create([
            'customer_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'cart_items' => json_encode($cartItems),
            'total' => $total,
            'status' => 'pending'
        ]);

        session()->forget('cart');

        return redirect()->route('cart')->with('success', 'Ваш заказ успешно создан! Менеджер свяжется с вами!');
    }

    // === Страница заказов ===
    public function orders()
    {
        $orders = Order::latest()->get(); // Все заказы (можно фильтровать)
        return view('orders', compact('orders'));
    }

    public function destroyOrder(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Заказ #'.$order->id.' успешно удален');
    }

    // === Форма входа ===
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Неверные данные для входа.',
        ]);
    }

    // === Форма регистрации ===
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect('/');
    }
} 