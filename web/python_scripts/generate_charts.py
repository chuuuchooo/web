import matplotlib.pyplot as plt
import seaborn as sns
import json
import requests
from datetime import datetime
import os

# Set the style for all charts
plt.style.use('bmh')
sns.set_theme(style="whitegrid", font_scale=1.1)

# Set default figure size and DPI
plt.rcParams['figure.figsize'] = [8, 6]
plt.rcParams['figure.dpi'] = 200
plt.rcParams['savefig.dpi'] = 200

# Set font properties
plt.rcParams['font.family'] = 'sans-serif'
plt.rcParams['font.sans-serif'] = ['Arial', 'DejaVu Sans', 'Helvetica']
plt.rcParams['axes.labelsize'] = 12
plt.rcParams['axes.titlesize'] = 14
plt.rcParams['xtick.labelsize'] = 10
plt.rcParams['ytick.labelsize'] = 10

def fetch_data():
    """Fetch data from Laravel API endpoints"""
    base_url = 'http://127.0.0.1:8000/api'
    
    try:
        # Fetch Family Planning data
        fp_response = requests.get(f'{base_url}/family-planning/stats')
        fp_data = fp_response.json()
        
        # Fetch Immunization data
        imm_response = requests.get(f'{base_url}/immunization/stats')
        imm_data = imm_response.json()
        
        return fp_data, imm_data
    except requests.exceptions.RequestException as e:
        print(f"Error fetching data: {e}")
        return None, None

def save_chart(fig, filename, chart_type='bar'):
    """Save chart to file"""
    # Create charts directory if it doesn't exist
    os.makedirs('public/charts', exist_ok=True)
    
    # Adjust layout
    plt.tight_layout()
    
    # Save the chart with high quality
    fig.savefig(
        f'public/charts/{filename}',
        bbox_inches='tight',
        dpi=200,
        format='png',
        transparent=False,
        facecolor='white'
    )
    plt.close(fig)

def generate_fp_charts(fp_data):
    """Generate Family Planning charts"""
    if not fp_data:
        return
    
    # Monthly Records
    months = [datetime(record['year'], record['month'], 1).strftime('%B') for record in fp_data['monthlyRecords']]
    counts = [record['count'] for record in fp_data['monthlyRecords']]
    
    fig, ax = plt.subplots(figsize=(8, 5))
    bars = sns.barplot(x=months, y=counts, ax=ax, palette='viridis')
    ax.set_title('Monthly Family Planning Records', pad=15)
    ax.set_xlabel('Month', labelpad=8)
    ax.set_ylabel('Number of Records', labelpad=8)
    plt.xticks(rotation=45, ha='right')
    
    # Add value labels on top of bars
    for bar in bars.patches:
        ax.text(
            bar.get_x() + bar.get_width()/2,
            bar.get_height(),
            f'{int(bar.get_height())}',
            ha='center',
            va='bottom',
            fontsize=9
        )
    
    save_chart(fig, 'fp_monthly.png')
    
    # FP Methods
    methods = [record['fp_method'] for record in fp_data['fpMethods']]
    method_counts = [record['count'] for record in fp_data['fpMethods']]
    
    fig, ax = plt.subplots(figsize=(8, 5))
    bars = sns.barplot(x=methods, y=method_counts, ax=ax, palette='viridis')
    ax.set_title('FP Methods Used', pad=15)
    ax.set_xlabel('Method', labelpad=8)
    ax.set_ylabel('Count', labelpad=8)
    plt.xticks(rotation=45, ha='right')
    
    # Add value labels on top of bars
    for bar in bars.patches:
        ax.text(
            bar.get_x() + bar.get_width()/2,
            bar.get_height(),
            f'{int(bar.get_height())}',
            ha='center',
            va='bottom',
            fontsize=9
        )
    
    save_chart(fig, 'fp_methods.png')
    
    # WRA vs NWRA
    wra_stats = fp_data['wraStats']
    labels = ['WRA (15-49)', 'NWRA']
    sizes = [wra_stats['WRA'], wra_stats['NWRA']]
    
    fig, ax = plt.subplots(figsize=(2, 2))  # Very small size but high quality
    wedges, texts, autotexts = ax.pie(
        sizes,
        labels=labels,
        autopct='%1.1f%%',
        startangle=90,
        colors=sns.color_palette('viridis', len(sizes)),
        textprops={'fontsize': 8}
    )
    ax.axis('equal')
    ax.set_title('WRA vs NWRA (15-49)', pad=5, fontsize=10)
    
    # Make the percentage labels bold
    for autotext in autotexts:
        autotext.set_fontweight('bold')
    
    save_chart(fig, 'wra.png', 'pie')
    
    # Status of Records
    status_counts = fp_data['statusCounts']
    labels = list(status_counts.keys())
    sizes = list(status_counts.values())
    
    fig, ax = plt.subplots(figsize=(2, 2))  # Very small size but high quality
    wedges, texts, autotexts = ax.pie(
        sizes,
        labels=labels,
        autopct='%1.1f%%',
        startangle=90,
        colors=sns.color_palette('viridis', len(sizes)),
        textprops={'fontsize': 8}
    )
    ax.axis('equal')
    ax.set_title('Status of Family Planning Records', pad=5, fontsize=10)
    
    # Make the percentage labels bold
    for autotext in autotexts:
        autotext.set_fontweight('bold')
    
    save_chart(fig, 'fp_status.png', 'pie')

def generate_imm_charts(imm_data):
    """Generate Immunization charts"""
    if not imm_data:
        return
    
    # Monthly Records
    months = [datetime(record['year'], record['month'], 1).strftime('%B') for record in imm_data['monthlyRecords']]
    counts = [record['count'] for record in imm_data['monthlyRecords']]
    
    fig, ax = plt.subplots(figsize=(8, 5))
    bars = sns.barplot(x=months, y=counts, ax=ax, palette='viridis')
    ax.set_title('Monthly Immunization Records', pad=15)
    ax.set_xlabel('Month', labelpad=8)
    ax.set_ylabel('Number of Records', labelpad=8)
    plt.xticks(rotation=45, ha='right')
    
    # Add value labels on top of bars
    for bar in bars.patches:
        ax.text(
            bar.get_x() + bar.get_width()/2,
            bar.get_height(),
            f'{int(bar.get_height())}',
            ha='center',
            va='bottom',
            fontsize=9
        )
    
    save_chart(fig, 'imm_monthly.png')
    
    # Vaccines Given
    vaccines = {}
    for record in imm_data['vaccinesGiven']:
        if record['vaccine_type'] not in vaccines:
            vaccines[record['vaccine_type']] = {'Completed': 0, 'Not Completed': 0}
        vaccines[record['vaccine_type']][record['status']] = record['count']
    
    vaccine_types = list(vaccines.keys())
    completed = [vaccines[v]['Completed'] for v in vaccine_types]
    not_completed = [vaccines[v]['Not Completed'] for v in vaccine_types]
    
    fig, ax = plt.subplots(figsize=(10, 5))
    x = range(len(vaccine_types))
    width = 0.35
    
    bars1 = ax.bar([i - width/2 for i in x], completed, width, label='Completed', color=sns.color_palette('viridis')[0])
    bars2 = ax.bar([i + width/2 for i in x], not_completed, width, label='Not Completed', color=sns.color_palette('viridis')[1])
    
    ax.set_title('Vaccines Given', pad=15)
    ax.set_xlabel('Vaccine Type', labelpad=8)
    ax.set_ylabel('Count', labelpad=8)
    ax.set_xticks(x)
    ax.set_xticklabels(vaccine_types, rotation=45, ha='right')
    ax.legend(fontsize=10)
    
    # Add value labels on top of bars
    def add_labels(bars):
        for bar in bars:
            height = bar.get_height()
            ax.text(
                bar.get_x() + bar.get_width()/2,
                height,
                f'{int(height)}',
                ha='center',
                va='bottom',
                fontsize=9
            )
    
    add_labels(bars1)
    add_labels(bars2)
    
    save_chart(fig, 'vaccines.png')
    
    # Records per Purok
    puroks = [record['purok'] for record in imm_data['purokRecords']]
    counts = [record['count'] for record in imm_data['purokRecords']]
    
    fig, ax = plt.subplots(figsize=(8, 5))
    bars = sns.barplot(x=puroks, y=counts, ax=ax, palette='viridis')
    ax.set_title('Child Records per Purok', pad=15)
    ax.set_xlabel('Purok', labelpad=8)
    ax.set_ylabel('Number of Records', labelpad=8)
    plt.xticks(rotation=45, ha='right')
    
    # Add value labels on top of bars
    for bar in bars.patches:
        ax.text(
            bar.get_x() + bar.get_width()/2,
            bar.get_height(),
            f'{int(bar.get_height())}',
            ha='center',
            va='bottom',
            fontsize=9
        )
    
    save_chart(fig, 'purok.png')
    
    # Vaccination Status
    total_completed = sum(v['Completed'] for v in vaccines.values())
    total_not_completed = sum(v['Not Completed'] for v in vaccines.values())
    
    fig, ax = plt.subplots(figsize=(2, 2))  # Very small size but high quality
    wedges, texts, autotexts = ax.pie(
        [total_completed, total_not_completed],
        labels=['Completed', 'Not Completed'],
        autopct='%1.1f%%',
        startangle=90,
        colors=sns.color_palette('viridis', 2),
        textprops={'fontsize': 8}
    )
    ax.axis('equal')
    ax.set_title('Vaccination Status', pad=5, fontsize=10)
    
    # Make the percentage labels bold
    for autotext in autotexts:
        autotext.set_fontweight('bold')
    
    save_chart(fig, 'vaccination_status.png', 'pie')

def main():
    """Main function to generate all charts"""
    print("Fetching data from API...")
    fp_data, imm_data = fetch_data()
    
    if fp_data and imm_data:
        print("Generating Family Planning charts...")
        generate_fp_charts(fp_data)
        
        print("Generating Immunization charts...")
        generate_imm_charts(imm_data)
        
        print("All charts generated successfully!")
    else:
        print("Failed to fetch data from API. Please ensure the Laravel server is running.")

if __name__ == "__main__":
    main() 