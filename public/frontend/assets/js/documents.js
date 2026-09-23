/**
 * Frontend Documents Module JavaScript | PPM Poltekkes Kemenkes Medan
 * Handles Anti-IDM Blob PDF Preview Modal & AJAX Filter/Search
 */

document.addEventListener('DOMContentLoaded', () => {
    initPdfPreviewModal();
    initDocumentRepository();
});

/* ==========================================================================
   Anti-IDM Blob PDF Preview Modal
   ========================================================================== */
let currentBlobUrl = null;

function initPdfPreviewModal() {
    const modal = document.getElementById('pdf-preview-modal');
    if (!modal) return;

    const titleEl = document.getElementById('pdf-modal-title');
    const codeEl = document.getElementById('pdf-modal-code');
    const downloadBtn = document.getElementById('pdf-modal-download');
    const closeBtn = document.getElementById('pdf-modal-close');
    const frame = document.getElementById('pdf-modal-frame');
    const loadingEl = document.getElementById('pdf-modal-loading');
    const errorEl = document.getElementById('pdf-modal-error');
    const errorMsgEl = document.getElementById('pdf-modal-error-msg');

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');

        if (frame) {
            frame.src = 'about:blank';
            frame.classList.add('hidden');
        }

        if (currentBlobUrl) {
            URL.revokeObjectURL(currentBlobUrl);
            currentBlobUrl = null;
        }
    }

    async function openPdfPreview(previewUrl, downloadUrl, title, code) {
        if (titleEl) titleEl.textContent = title || 'Pratinjau Dokumen';
        if (codeEl) codeEl.textContent = code ? `Kode: ${code}` : 'Dokumen SPMI Poltekkes Kemenkes Medan';
        if (downloadBtn) downloadBtn.href = downloadUrl || previewUrl;

        // Reset state
        if (loadingEl) loadingEl.classList.remove('hidden');
        if (errorEl) errorEl.classList.add('hidden');
        if (frame) frame.classList.add('hidden');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        try {
            // Anti-IDM Strategy: fetch as binary blob with X-Preview-Request header
            const response = await fetch(previewUrl, {
                headers: {
                    'X-Preview-Request': '1',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: Berkas tidak dapat diakses.`);
            }

            const blob = await response.blob();
            if (currentBlobUrl) {
                URL.revokeObjectURL(currentBlobUrl);
            }

            currentBlobUrl = URL.createObjectURL(blob);
            if (frame) {
                frame.src = currentBlobUrl;
                frame.classList.remove('hidden');
            }
            if (loadingEl) loadingEl.classList.add('hidden');
        } catch (err) {
            console.error('[PDF Preview Error]', err);
            if (loadingEl) loadingEl.classList.add('hidden');
            if (errorEl) {
                errorEl.classList.remove('hidden');
                if (errorMsgEl) errorMsgEl.textContent = err.message || 'Terjadi kesalahan saat mengunduh berkas.';
            }
        }
    }

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-preview-pdf');
        if (btn) {
            e.preventDefault();
            const previewUrl = btn.dataset.previewUrl;
            const downloadUrl = btn.dataset.downloadUrl;
            const title = btn.dataset.title;
            const code = btn.dataset.code;

            if (previewUrl) {
                openPdfPreview(previewUrl, downloadUrl, title, code);
            }
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
}

/* ==========================================================================
   Document Repository AJAX Filter & Search
   ========================================================================== */
function initDocumentRepository() {
    const container = document.getElementById('document-table-container');
    if (!container) return;

    const searchInput = document.getElementById('doc-search-input');
    const yearSelect = document.getElementById('doc-year-select');
    const categoryPills = document.querySelectorAll('.doc-category-pill');
    const tableBody = document.getElementById('doc-table-body');
    const loadingOverlay = document.getElementById('doc-table-loading');
    const fetchUrl = container.dataset.fetchUrl;

    let selectedCategory = '';
    let searchDebounceTimer = null;

    async function fetchDocuments(pageUrl = null) {
        if (loadingOverlay) loadingOverlay.classList.remove('hidden');

        const params = new URLSearchParams();
        if (searchInput && searchInput.value.trim()) {
            params.set('search', searchInput.value.trim());
        }
        if (yearSelect && yearSelect.value) {
            params.set('year', yearSelect.value);
        }
        if (selectedCategory) {
            params.set('category_id', selectedCategory);
        }

        const url = pageUrl || `${fetchUrl}?${params.toString()}`;

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) throw new Error('Gagal memuat data');

            const html = await response.text();
            if (tableBody) {
                tableBody.innerHTML = html;
            }

            if (typeof feather !== 'undefined') feather.replace();
        } catch (err) {
            console.error('[Document Fetch Error]', err);
        } finally {
            if (loadingOverlay) loadingOverlay.classList.add('hidden');
        }
    }

    // Debounced Search Input
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(() => {
                fetchDocuments();
            }, 300);
        });
    }

    // Year Dropdown
    if (yearSelect) {
        yearSelect.addEventListener('change', () => {
            fetchDocuments();
        });
    }

    // Category Pills
    categoryPills.forEach((pill) => {
        pill.addEventListener('click', () => {
            selectedCategory = pill.dataset.categoryId || '';

            // Update UI classes
            categoryPills.forEach((p) => {
                p.classList.remove('bg-[#0BB5CB]', 'text-white', 'shadow-2xs');
                p.classList.add('bg-slate-100', 'text-slate-600');
            });

            pill.classList.add('bg-[#0BB5CB]', 'text-white', 'shadow-2xs');
            pill.classList.remove('bg-slate-100', 'text-slate-600');

            fetchDocuments();
        });
    });

    // Pagination Click Interception (AJAX pagination)
    if (tableBody) {
        tableBody.addEventListener('click', (e) => {
            const paginationLink = e.target.closest('.pagination a, [rel="next"], [rel="prev"]');
            if (paginationLink && paginationLink.href) {
                e.preventDefault();
                fetchDocuments(paginationLink.href);
            }
        });
    }
}
