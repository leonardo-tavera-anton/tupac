import { Head, Link } from '@inertiajs/react';

export default function Welcome() {
  return (
    <>
      <Head title="Bienvenido" />

      <div className="min-h-screen bg-gradient-to-br from-indigo-600 to-blue-400 flex flex-col items-center justify-center text-white px-6">
        
        <h1 className="text-5xl font-extrabold mb-4 text-center">
          ¡Bienvenido a la Plataforma Municipal!
        </h1>

        <p className="text-lg mb-8 text-center max-w-xl">
          Esta es tu app moderna construida con Laravel, Inertia y React — lista para administrar tu contenido y servicios municipales.
        </p>

        <div className="flex gap-4">
          <Link
            href="/dashboard"
            className="bg-white text-indigo-700 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition"
          >
            Ir al Dashboard
          </Link>

          <Link
            href="/login"
            className="bg-indigo-800 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-indigo-900 transition"
          >
            Iniciar Sesión
          </Link>
        </div>

        <footer className="mt-16 text-sm opacity-80">
          © {new Date().getFullYear()} Municipalidad — Todos los derechos reservados
        </footer>

      </div>
    </>
  );
}
