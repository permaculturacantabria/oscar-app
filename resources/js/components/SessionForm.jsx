import React, { useEffect, useState } from 'react';

const SessionForm = ({ onClose, onCreated }) => {
    const [listeners, setListeners] = useState([]);
    const [listenerId, setListenerId] = useState('');
    const [listenerName, setListenerName] = useState('');
    const [date, setDate] = useState('');
    const [time, setTime] = useState('');
    const [status, setStatus] = useState('pendiente');
    const [notes, setNotes] = useState('');
    const [saving, setSaving] = useState(false);
    const [error, setError] = useState('');

    useEffect(() => {
        fetch('/api/listeners', { credentials: 'same-origin' })
            .then(r => r.ok ? r.json() : Promise.reject())
            .then(data => setListeners(data))
            .catch(() => setListeners([]));
    }, []);

    const combineDateTime = () => {
        if (!date || !time) return '';
        return new Date(`${date}T${time}:00`).toISOString();
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        setSaving(true);
        try {
            const scheduled_at = combineDateTime();
            const payload = {
                listener_id: listenerId || null,
                listener_name: listenerId ? null : (listenerName || null),
                scheduled_at,
                status,
                notes: notes || null,
                categories: null,
            };
            const res = await window.axios.post('/api/sessions', payload);
            onCreated?.(res.data);
            onClose?.();
        } catch (err) {
            setError('No se pudo guardar la sesión.');
        } finally {
            setSaving(false);
        }
    };

    return (
        <div className="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div className="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 w-full max-w-lg rounded-lg shadow-lg">
                <div className="p-4 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center">
                    <h2 className="text-lg font-semibold">Añadir sesión</h2>
                    <button onClick={onClose} className="text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">✕</button>
                </div>
                <form onSubmit={handleSubmit} className="p-4 space-y-4">
                    {error && <div className="text-red-600 text-sm">{error}</div>}

                    <div>
                        <label className="block text-sm mb-1">Escucha (seleccionar)</label>
                        <select
                            value={listenerId}
                            onChange={(e) => setListenerId(e.target.value)}
                            className="w-full bg-gray-100 dark:bg-gray-800 rounded px-3 py-2"
                        >
                            <option value="">— Ninguno —</option>
                            {listeners.map(l => (
                                <option key={l.id} value={l.id}>{l.name}</option>
                            ))}
                        </select>
                    </div>

                    <div>
                        <label className="block text-sm mb-1">O nombre de nuevo escucha</label>
                        <input
                            type="text"
                            value={listenerName}
                            onChange={(e) => setListenerName(e.target.value)}
                            placeholder="Nombre del escucha"
                            className="w-full bg-gray-100 dark:bg-gray-800 rounded px-3 py-2"
                            disabled={!!listenerId}
                        />
                    </div>

                    <div className="grid grid-cols-2 gap-3">
                        <div>
                            <label className="block text-sm mb-1">Día</label>
                            <input type="date" value={date} onChange={(e) => setDate(e.target.value)} className="w-full bg-gray-100 dark:bg-gray-800 rounded px-3 py-2" required />
                        </div>
                        <div>
                            <label className="block text-sm mb-1">Hora</label>
                            <input type="time" value={time} onChange={(e) => setTime(e.target.value)} className="w-full bg-gray-100 dark:bg-gray-800 rounded px-3 py-2" required />
                        </div>
                    </div>

                    <div>
                        <label className="block text-sm mb-1">Estado</label>
                        <select value={status} onChange={(e) => setStatus(e.target.value)} className="w-full bg-gray-100 dark:bg-gray-800 rounded px-3 py-2">
                            <option value="pendiente">Pendiente</option>
                            <option value="realizada">Realizada</option>
                        </select>
                    </div>

                    <div>
                        <label className="block text-sm mb-1">Notas</label>
                        <textarea value={notes} onChange={(e) => setNotes(e.target.value)} rows={4} className="w-full bg-gray-100 dark:bg-gray-800 rounded px-3 py-2" placeholder="Notas de la sesión..."></textarea>
                    </div>

                    <div className="pt-2 flex justify-end gap-2">
                        <button type="button" onClick={onClose} className="px-4 py-2 rounded border border-gray-300 dark:border-gray-700">Cancelar</button>
                        <button disabled={saving} type="submit" className="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">
                            {saving ? 'Guardando...' : 'Guardar sesión'}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default SessionForm;


