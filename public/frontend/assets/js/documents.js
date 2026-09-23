/**
 * Frontend Documents Module JavaScript | PPM Poltekkes Kemenkes Medan
 * Handles Anti-IDM Blob PDF Preview Modal, Custom Dropdown Filters & AJAX Search
 */

document.addEventListener('DOMContentLoaded', () => {
    initPdfPreviewModal();
    initDocumentRepository();
    if (typeof feather !== 'undefined') feather.replace();
});

/* ==========================================================================
   Anti-IDM Blob PDF Preview Modal
   ========================================================================== */
let currentBlobUrl = null;
let currentPdfAbortController = null;

function initPdfPreviewModal() {
    const modal = document.getElementById('pdf-preview-modal');
    if (!modal) return;

    const titleEl = document.getElementById('pdf-modal-title');
    const codeEl = document.getElementById('pdf-modal-code');
    const linkEl = document.getElementById('pdf-modal-link');
    const downloadBtn = document.getElementById('pdf-modal-download');
    const closeBtn = document.getElementById('pdf-modal-close');
    const frame = document.getElementById('pdf-modal-frame');
    const loadingEl = document.getElementById('pdf-modal-loading');
    const fallbackEl = document.getElementById('pdf-modal-fallback');
    const fallbackLinkEl = document.getElementById('pdf-modal-fallback-link');

    function closeModal() {
        if (currentPdfAbortController) {
            currentPdfAbortController.abort();
            currentPdfAbortController = null;
        }

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');

        if (frame) {
            frame.src = 'about:blank';
        }

        if (fallbackEl) {
            fallbackEl.classList.add('hidden');
        }

        if (currentBlobUrl) {
            URL.revokeObjectURL(currentBlobUrl);
            currentBlobUrl = null;
        }
    }

    const renderBlobInIframe = (blobUrl) => {
        if (!frame) return;

        let loadHandled = false;
        const hideLoading = () => {
            if (loadHandled) return;
            loadHandled = true;
            if (loadingEl) {
                loadingEl.classList.add('hidden');
            }
        };

        frame.onload = hideLoading;
        frame.onerror = hideLoading;

        // Safety timeout: Native PDF viewers in Chromium may take a moment
        setTimeout(hideLoading, 700);

        // Fallback prompt after delay if iframe cannot render on mobile devices
        setTimeout(() => {
            if (fallbackEl) {
                fallbackEl.classList.remove('hidden');
                if (typeof feather !== 'undefined') feather.replace();
            }
        }, 4000);

        frame.src = blobUrl;
    };

    async function openPdfPreview(previewUrl, downloadUrl, title, code) {
        if (!previewUrl) return;

        const fileDownloadUrl = downloadUrl || previewUrl;
        const safeTitle = (title || 'Dokumen').replace(/\.[^/.]+$/, '');
        const downloadFileName = `${safeTitle}.pdf`;

        if (titleEl) titleEl.textContent = title || 'Pratinjau Dokumen PDF';
        if (codeEl) codeEl.textContent = code ? `Kode: ${code}` : 'Dokumen resmi Pusat Penjaminan Mutu Poltekkes Kemenkes Medan';

        if (linkEl) {
            linkEl.href = fileDownloadUrl;
            linkEl.setAttribute('title', 'Buka dokumen di tab baru');
        }

        if (downloadBtn) {
            downloadBtn.href = fileDownloadUrl;
            downloadBtn.setAttribute('download', downloadFileName);
            downloadBtn.setAttribute('title', 'Unduh berkas PDF');
        }

        if (fallbackLinkEl) {
            fallbackLinkEl.href = fileDownloadUrl;
        }

        if (fallbackEl) {
            fallbackEl.classList.add('hidden');
        }

        if (loadingEl) {
            loadingEl.classList.remove('hidden');
        }

        // Cancel any ongoing fetch request
        if (currentPdfAbortController) {
            currentPdfAbortController.abort();
            currentPdfAbortController = null;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        // Case A: Source is already a local Blob URL
        if (typeof previewUrl === 'string' && previewUrl.startsWith('blob:')) {
            if (currentBlobUrl && currentBlobUrl !== previewUrl) {
                URL.revokeObjectURL(currentBlobUrl);
            }
            currentBlobUrl = previewUrl;
            renderBlobInIframe(previewUrl);
            return;
        }

        // Case B: Fetch as Blob via AJAX to PREVENT Internet Download Manager (IDM) from hijacking!
        currentPdfAbortController = new AbortController();

        try {
            const response = await fetch(previewUrl, {
                signal: currentPdfAbortController.signal,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-Preview-Request': '1',
                    'Accept': 'application/octet-stream, application/pdf',
                },
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: Berkas tidak dapat diakses.`);
            }

            const blob = await response.blob();
            if (currentBlobUrl) {
                URL.revokeObjectURL(currentBlobUrl);
            }

            // Explicitly force application/pdf MIME type on the blob so browser iframe displays it
            const blobUrl = URL.createObjectURL(new Blob([blob], { type: 'application/pdf' }));
            currentBlobUrl = blobUrl;

            renderBlobInIframe(blobUrl);
        } catch (err) {
            if (err.name === 'AbortError') return;
            console.warn('[PDF Preview Fetch Warning]', err);

            if (loadingEl) {
                loadingEl.classList.add('hidden');
            }
            if (fallbackEl) {
                fallbackEl.classList.remove('hidden');
                if (typeof feather !== 'undefined') feather.replace();
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
   Document Repository AJAX Filter & Search System
   ========================================================================== */
function initDocumentRepository() {
    const container = document.getElementById('document-table-container');
    if (!container) return;

    const searchInput = document.getElementById('doc-search-input');
    const searchClearBtn = document.getElementById('doc-search-clear');
    const categorySelect = document.getElementById('doc-category-select');
    const yearSelect = document.getElementById('doc-year-select');
    const activeFiltersRow = document.getElementById('active-filters-row');
    const activeFilterTags = document.getElementById('active-filter-tags');
    const resetFiltersBtn = document.getElementById('btn-reset-filters');
    const tableBody = document.getElementById('doc-table-body');
    const loadingOverlay = document.getElementById('doc-table-loading');
    const fetchUrl = container.dataset.fetchUrl;

    let searchDebounceTimer = null;

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/[&<>'"]/g, 
            tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
        );
    }

    function updateActiveFiltersUI() {
        if (!activeFiltersRow || !activeFilterTags) return;

        const searchVal = searchInput ? searchInput.value.trim() : '';
        const catVal = categorySelect ? categorySelect.value : '';
        const yearVal = yearSelect ? yearSelect.value : '';

        // Search clear button visibility
        if (searchClearBtn) {
            if (searchVal) {
                searchClearBtn.classList.remove('hidden');
            } else {
                searchClearBtn.classList.add('hidden');
            }
        }

        if (!searchVal && !catVal && !yearVal) {
            activeFiltersRow.classList.add('hidden');
            activeFilterTags.innerHTML = '<span class="text-xs font-semibold text-slate-400">Filter Aktif:</span>';
            return;
        }

        activeFiltersRow.classList.remove('hidden');
        let tagsHtml = '<span class="text-xs font-semibold text-slate-400">Filter Aktif:</span>';

        if (searchVal) {
            tagsHtml += `
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-100 text-xs font-semibold text-slate-700 border border-slate-200/80 shadow-2xs">
                    <span>Kata Kunci: "${escapeHtml(searchVal)}"</span>
                    <button type="button" class="btn-remove-tag text-slate-400 hover:text-rose-600 transition-colors cursor-pointer" data-filter="search" title="Hapus pencarian">
                        <i data-feather="x" class="w-3.5 h-3.5"></i>
                    </button>
                </span>
            `;
        }

        if (catVal && categorySelect) {
            const catOpt = categorySelect.options[categorySelect.selectedIndex];
            const catLabel = catOpt ? catOpt.text : 'Kategori';
            tagsHtml += `
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-[#0BB5CB]/10 text-xs font-semibold text-[#028DA9] border border-[#0BB5CB]/20 shadow-2xs">
                    <span>${escapeHtml(catLabel)}</span>
                    <button type="button" class="btn-remove-tag text-[#028DA9] hover:text-rose-600 transition-colors cursor-pointer" data-filter="category" title="Hapus filter kategori">
                        <i data-feather="x" class="w-3.5 h-3.5"></i>
                    </button>
                </span>
            `;
        }

        if (yearVal) {
            tagsHtml += `
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-100 text-xs font-semibold text-slate-700 border border-slate-200/80 shadow-2xs">
                    <span>Tahun: ${escapeHtml(yearVal)}</span>
                    <button type="button" class="btn-remove-tag text-slate-400 hover:text-rose-600 transition-colors cursor-pointer" data-filter="year" title="Hapus filter tahun">
                        <i data-feather="x" class="w-3.5 h-3.5"></i>
                    </button>
                </span>
            `;
        }

        activeFilterTags.innerHTML = tagsHtml;
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }

    function scrollToTableTop() {
        if (!container) return;
        const navbar = document.querySelector('header') || document.querySelector('nav');
        const navOffset = navbar ? navbar.offsetHeight : 80;
        const targetTop = container.getBoundingClientRect().top + window.pageYOffset - navOffset - 24;

        window.scrollTo({
            top: Math.max(0, targetTop),
            behavior: 'smooth'
        });
    }

    async function fetchDocuments(pageUrl = null, shouldScroll = false) {
        if (loadingOverlay) loadingOverlay.classList.remove('hidden');

        if (shouldScroll || pageUrl) {
            scrollToTableTop();
        }

        const params = new URLSearchParams();
        if (searchInput && searchInput.value.trim()) {
            params.set('search', searchInput.value.trim());
        }
        if (yearSelect && yearSelect.value) {
            params.set('year', yearSelect.value);
        }
        if (categorySelect && categorySelect.value) {
            params.set('category_id', categorySelect.value);
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

            // Update browser URL without reloading
            window.history.replaceState(null, '', url);
            updateActiveFiltersUI();

            if (shouldScroll || pageUrl) {
                scrollToTableTop();
            }
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
            updateActiveFiltersUI();
            searchDebounceTimer = setTimeout(() => {
                fetchDocuments();
            }, 300);
        });
    }

    // Search Clear Button Click
    if (searchClearBtn) {
        searchClearBtn.addEventListener('click', () => {
            if (searchInput) {
                searchInput.value = '';
                searchInput.focus();
            }
            fetchDocuments();
        });
    }

    // Category Select Change
    if (categorySelect) {
        categorySelect.addEventListener('change', () => {
            fetchDocuments(null, true);
        });
    }

    // Year Select Change
    if (yearSelect) {
        yearSelect.addEventListener('change', () => {
            fetchDocuments(null, true);
        });
    }

    // Remove individual filter tag
    if (activeFilterTags) {
        activeFilterTags.addEventListener('click', (e) => {
            const btn = e.target.closest('.btn-remove-tag');
            if (!btn) return;
            const filterType = btn.dataset.filter;

            if (filterType === 'search' && searchInput) {
                searchInput.value = '';
            } else if (filterType === 'category' && categorySelect) {
                categorySelect.value = '';
                categorySelect.dispatchEvent(new Event('change', { bubbles: true }));
            } else if (filterType === 'year' && yearSelect) {
                yearSelect.value = '';
                yearSelect.dispatchEvent(new Event('change', { bubbles: true }));
            }

            fetchDocuments(null, true);
        });
    }

    // Reset All Filters Button
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            if (categorySelect) {
                categorySelect.value = '';
                categorySelect.dispatchEvent(new Event('change', { bubbles: true }));
            }
            if (yearSelect) {
                yearSelect.value = '';
                yearSelect.dispatchEvent(new Event('change', { bubbles: true }));
            }
            fetchDocuments(fetchUrl, true);
        });
    }

    // Pagination Click Interception (AJAX pagination with auto-scroll)
    if (tableBody) {
        tableBody.addEventListener('click', (e) => {
            const paginationLink = e.target.closest('.pagination a, [rel="next"], [rel="prev"]');
            if (paginationLink && paginationLink.href) {
                e.preventDefault();
                fetchDocuments(paginationLink.href, true);
            }
        });
    }

    // Initial check for pre-filled query params
    updateActiveFiltersUI();
}
